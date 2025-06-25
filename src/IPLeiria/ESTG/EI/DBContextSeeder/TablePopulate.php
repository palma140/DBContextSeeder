<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder;

use Exception;
use Illuminate\Support\Facades\DB;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous\FileSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous\SequentionalNumberSeeder;
use League\Csv\Reader;

/**
 * Class TablePopulate
 *
 * This class is responsible for populating database tables with data from various sources like seeders,
 * CSV, JSON, or arrays. It supports features like batch inserts, retries on failure, and pre- and post-population callbacks.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder
 */
class TablePopulate
{
    /**
     * The table seeder instance used to populate the data.
     *
     * @var TableSeeder
     */
    protected TableSeeder $seeder;

    /**
     * Optional callback to be executed before the table population process.
     * Can be a Closure or any callable.
     *
     * @var \Closure|null
     */
    protected ?\Closure $beforeCallback = null;

    /**
     * Optional callback to be executed after the table population process.
     * Can be a Closure or any callable.
     *
     * @var \Closure|null
     */
    protected ?\Closure $afterCallback = null;

    /**
     * Constructor that receives the table seeder.
     *
     * @param TableSeeder $seeder The seeder instance to populate the table.
     */
    public function __construct(TableSeeder $seeder)
    {
        $this->seeder = $seeder;
    }

    /**
     * Sets a callback to be executed before the table population process.
     *
     * @param callable $callback Function or Closure to be executed before populating.
     * @return TablePopulate Returns the current instance to allow method chaining.
     */
    public function before(callable $callback): TablePopulate
    {
        // Ensures the callback is stored as a Closure
        $this->beforeCallback = $callback instanceof \Closure ? $callback : $callback(...);
        return $this;
    }

    /**
     * Sets a callback to be executed after the table population process.
     *
     * @param callable $callback Function or Closure to be executed after populating.
     * @return TablePopulate Returns the current instance to allow method chaining.
     */
    public function after(callable $callback): TablePopulate
    {
        // Ensures the callback is stored as a Closure
        $this->afterCallback = $callback instanceof \Closure ? $callback : $callback(...);
        return $this;
    }

    /**
     * Populates the table with generated data or data from a callable count.
     *
     * @param int|callable $count Number of records to insert or a callable returning that number.
     * @param int $batchSize Number of records to insert per batch (default: 1000).
     * @param int $maxRetries Number of retries per batch on failure (default: 1).
     * @param bool $verbose Whether to show detailed error messages (default: false).
     *
     * @throws \InvalidArgumentException if $count is not an integer or a callable returning integer.
     * @throws \Exception if maximum retries are exceeded during batch insert.
     *
     * @return void
     */
    public function populate(int|callable $count, int $batchSize = 1000, int $maxRetries = 1, bool $verbose = false): void
    {
        if (is_callable($count)) {
            $count = call_user_func($count);
        }

        if (!is_int($count)) {
            throw new \InvalidArgumentException("The count must be an integer or a callback that returns an integer.");
        }

        if ($this->beforeCallback) {
            ($this->beforeCallback)();
        }

        $driver = DB::getDriverName();
        $this->disableForeignKeyChecks($driver);

        DB::table($this->seeder->getTable())->truncate();
        echo "\e[33m⚠️ Table truncated: {$this->seeder->getTable()}.\e[0m\n";

        $fields = $this->seeder->getFields();
        $table = $this->seeder->getTable();
        $inserted = 0;

        while ($inserted < $count) {
            $success = false;
            $attempts = 0;
            $batch = null;

            while (!$success && $attempts < $maxRetries) {
                // CORREÇÃO 1: Fazer backup ANTES de gerar o batch
                $fieldStates = [];
                foreach ($fields as $fieldName => $fieldSeeder) {
                    if ($fieldSeeder instanceof SequentionalNumberSeeder) {
                        $fieldStates[$fieldName] = $fieldSeeder->getCurrentNumber();
                    } elseif ($fieldSeeder instanceof FileSeeder) {
                        $fieldSeeder->backupState(); // Backup antes de gerar
                    }
                }

                $batch = [];

                // Gerar o batch
                for ($i = 0; $i < min($batchSize, $count - $inserted); $i++) {
                    $batch[] = $this->generateRow($fields);
                }

                try {
                    DB::table($table)->insert($batch);
                    $inserted += count($batch);
                    echo "\e[32m✅ Inserted {$inserted}/{$count} records into {$table}...\e[0m\n";
                    $success = true;
                } catch (\Exception $e) {
                    $attempts++;

                    // CORREÇÃO 2: Restaurar estado após falha
                    foreach ($fields as $fieldName => $fieldSeeder) {
                        if ($fieldSeeder instanceof SequentionalNumberSeeder) {
                            $fieldSeeder->setCurrentNumber($fieldStates[$fieldName]);
                        } elseif ($fieldSeeder instanceof FileSeeder) {
                            $fieldSeeder->restoreState(); // Restaurar arquivos
                        }
                    }

                    $error = $verbose ? $e->getMessage() : $this->extractRelevantSqlError($e->getMessage());
                    echo "\e[33m⚠️ Attempt {$attempts} failed: $error\e[0m\n";

                    if ($attempts >= $maxRetries) {
                        echo "\e[31m❌ Max retries reached. Aborting...\e[0m\n";
                        throw new \Exception("Failed to insert batch after {$maxRetries} attempts: " . $e->getMessage());
                    }
                }
            }
        }

        $this->enableForeignKeyChecks($driver);

        if ($this->afterCallback) {
            ($this->afterCallback)();
        }

        echo "\e[32m🎉 Population completed for {$table}: {$count} records inserted.\e[0m\n";
    }


    /**
     * Disables foreign key checks for the current database driver to allow
     * truncating and inserting data without constraint errors.
     *
     * @param string $driver Database driver name.
     * @return void
     */
    protected function disableForeignKeyChecks(string $driver): void
    {
        try {
            match ($driver) {
                'mysql' => DB::statement('SET FOREIGN_KEY_CHECKS=0;'),
                'sqlite' => DB::statement('PRAGMA foreign_keys = OFF;'),
                'pgsql' => DB::statement('SET CONSTRAINTS ALL DEFERRED;'),
                'sqlsrv' => DB::statement('ALTER TABLE ' . $this->seeder->getTable() . ' NOCHECK CONSTRAINT ALL;'),
                'oracle' => DB::statement("
                BEGIN
                    FOR c IN (SELECT constraint_name, table_name FROM user_constraints WHERE constraint_type = 'R') LOOP
                        EXECUTE IMMEDIATE 'ALTER TABLE ' || c.table_name || ' DISABLE CONSTRAINT ' || c.constraint_name;
                    END LOOP;
                END;
            "),
                default => null,
            };
        } catch (\Throwable $e) {
            echo "\e[33m⚠️ Could not disable foreign key checks for driver [$driver]: {$e->getMessage()}\e[0m\n";
        }
    }

    /**
     * Enables foreign key checks after data insertion to restore
     * referential integrity enforcement.
     *
     * @param string $driver Database driver name.
     * @return void
     */
    protected function enableForeignKeyChecks(string $driver): void
    {
        try {
            match ($driver) {
                'mysql' => DB::statement('SET FOREIGN_KEY_CHECKS=1;'),
                'sqlite' => DB::statement('PRAGMA foreign_keys = ON;'),
                'pgsql' => DB::statement('SET CONSTRAINTS ALL IMMEDIATE;'),
                'sqlsrv' => DB::statement('ALTER TABLE ' . $this->seeder->getTable() . ' CHECK CONSTRAINT ALL;'),
                'oracle' => DB::statement("
                BEGIN
                    FOR c IN (SELECT constraint_name, table_name FROM user_constraints WHERE constraint_type = 'R') LOOP
                        EXECUTE IMMEDIATE 'ALTER TABLE ' || c.table_name || ' ENABLE CONSTRAINT ' || c.constraint_name;
                    END LOOP;
                END;
            "),
                default => null,
            };
        } catch (\Throwable $e) {
            echo "\e[33m⚠️ Could not enable foreign key checks for driver [$driver]: {$e->getMessage()}\e[0m\n";
        }
    }

    /**
     * Extracts the most relevant part of an SQL error message, trimming connection details.
     *
     * @param string $message Full error message.
     * @return string Cleaned error message.
     */
    private function extractRelevantSqlError(string $message): string
    {
        return preg_replace('/ \(Connection:.*$/', '', $message);
    }

    /**
     * Generates a single row of data based on the defined field seeders.
     * Supports overrides for specific fields.
     *
     * @param array $fields Array of field seeders keyed by field name.
     * @param array $overrides Optional associative array of field => value to override generation.
     * @return array Generated row data.
     */
    private function generateRow(array $fields, array $overrides = []): array
    {
        $row = [];

        foreach ($fields as $field => $fieldSeeder) {
            if (array_key_exists($field, $overrides)) {
                $row[$field] = $overrides[$field];
            } else {
                $row[$field] = $fieldSeeder->generate($row);
            }
        }

        return $row;
    }

    /**
     * Populates the table by importing data from a CSV file.
     * Supports batch inserts and automatically generates missing fields.
     *
     * @param string $csvPath Path to the CSV file.
     * @param int $batchSize Number of records to insert per batch (default: 1000).
     * @return void
     */
    public function populateFromCSV(string $csvPath, int $batchSize = 1000): void
    {
        try {
            if ($this->beforeCallback) {
                ($this->beforeCallback)();
            }

            if (!file_exists($csvPath) || !is_readable($csvPath)) {
                throw new Exception("CSV file not found or not readable: $csvPath");
            }

            $driver = DB::getDriverName();
            $this->disableForeignKeyChecks($driver);
            DB::table($this->seeder->getTable())->truncate();
            echo "\e[33m⚠️ Table truncated: {$this->seeder->getTable()}.\e[0m\n";

            $csv = Reader::createFromPath($csvPath, 'r');
            $csv->setHeaderOffset(0);

            $table = $this->seeder->getTable();
            $fields = $this->seeder->getFields();

            $batch = [];
            $inserted = 0;

            foreach ($csv as $record) {
                // Generate missing fields if not present in CSV
                foreach ($this->seeder->getFields() as $field => $fieldSeeder) {
                    if (!array_key_exists($field, $record)) {
                        $record[$field] = $fieldSeeder->generate($record);
                    }
                }
                $row = $this->generateRow($fields, $record);
                $batch[] = $row;

                if (count($batch) >= $batchSize) {
                    DB::table($table)->insert($batch);
                    $inserted += count($batch);
                    echo "\e[32m✅ Inserted {$inserted} records into {$table}...\e[0m\n";
                    $batch = [];
                }
            }

            if (!empty($batch)) {
                DB::table($table)->insert($batch);
                $inserted += count($batch);
                echo "\e[32m✅ Inserted {$inserted} records into {$table}...\e[0m\n";
            }

            $this->enableForeignKeyChecks($driver);

            if ($this->afterCallback) {
                ($this->afterCallback)();
            }

            echo "\e[32m🎉 CSV Import completed! {$inserted} records inserted into {$table}.\e[0m\n";

        } catch (Exception $e) {
            echo "\e[31m❌ Error during CSV import: {$e->getMessage()}\e[0m\n";
        }
    }


    /**
     * Populates the table with data from a JSON file.
     *
     * @param string $jsonPath The path to the JSON file.
     * @param int $batchSize The number of records to insert per batch (default: 1000).
     * @throws Exception If the JSON file is not found, not readable, or invalid.
     */
    public function populateFromJSON(string $jsonPath, int $batchSize = 1000): void
    {
        try {
            if ($this->beforeCallback) {
                ($this->beforeCallback)();
            }

            if (!file_exists($jsonPath) || !is_readable($jsonPath)) {
                throw new Exception("JSON file not found or not readable: $jsonPath");
            }

            $driver = DB::getDriverName();
            $this->disableForeignKeyChecks($driver);
            DB::table($this->seeder->getTable())->truncate();
            $this->enableForeignKeyChecks($driver);

            echo "\e[33m⚠️ Table truncated: {$this->seeder->getTable()}.\e[0m\n";

            $jsonContent = file_get_contents($jsonPath);
            $records = json_decode($jsonContent, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Invalid JSON: ' . json_last_error_msg());
            }

            if (!is_array($records)) {
                throw new Exception('Invalid JSON format: Expected an array of records.');
            }

            $table = $this->seeder->getTable();
            $inserted = 0;
            $batch = [];

            foreach ($records as $record) {
                $batch[] = $record;
                foreach ($this->seeder->getFields() as $field => $fieldSeeder) {
                    if (!array_key_exists($field, $record)) {
                        $record[$field] = $fieldSeeder->generate($record);
                    }
                }

                if (count($batch) >= $batchSize) {
                    DB::table($table)->insert($batch);
                    $inserted += count($batch);
                    echo "\e[32m✅ Inserted {$inserted} records into {$table}...\e[0m\n";
                    $batch = [];
                }
            }

            if (!empty($batch)) {
                DB::table($table)->insert($batch);
                $inserted += count($batch);
                echo "\e[32m✅ Inserted {$inserted} records into {$table}...\e[0m\n";
            }

            if ($this->afterCallback) {
                ($this->afterCallback)();
            }

            echo "\e[32m🎉 JSON Import Completed! {$inserted} records inserted into {$table}.\e[0m\n";
        } catch (Exception $e) {
            echo "\e[31m❌ Error: {$e->getMessage()}\e[0m\n";
        }
    }

    /**
     * Populates the table with data from an array.
     *
     * @param array $data The data array to insert into the table.
     * @param int $batchSize The number of records to insert per batch (default: 1000).
     * @throws Exception If the input array is empty.
     */
    public function populateFromArray(array $data, int $batchSize = 1000): void
    {
        try {
            if ($this->beforeCallback) {
                ($this->beforeCallback)();
            }

            if (empty($data)) {
                throw new Exception('Input array is empty.');
            }

            $driver = DB::getDriverName();
            $this->disableForeignKeyChecks($driver);
            DB::table($this->seeder->getTable())->truncate();
            $this->enableForeignKeyChecks($driver);

            echo "\e[33m⚠️ Table truncated: {$this->seeder->getTable()}.\e[0m\n";

            $table = $this->seeder->getTable();
            $inserted = 0;
            $batch = [];

            foreach ($data as $record) {
                // Aplica os FieldSeeders para campos não definidos
                foreach ($this->seeder->getFields() as $field => $fieldSeeder) {
                    if (!array_key_exists($field, $record)) {
                        $record[$field] = $fieldSeeder->generate($record);
                    }
                }

                $batch[] = $record;

                if (count($batch) >= $batchSize) {
                    DB::table($table)->insert($batch);
                    $inserted += count($batch);
                    echo "\e[32m✅ Inserted {$inserted} records into {$table}...\e[0m\n";
                    $batch = [];
                }
            }

            if (!empty($batch)) {
                DB::table($table)->insert($batch);
                $inserted += count($batch);
                echo "\e[32m✅ Inserted {$inserted} records into {$table}...\e[0m\n";
            }

            if ($this->afterCallback) {
                ($this->afterCallback)();
            }

            echo "\e[32m🎉 Array Import Completed! {$inserted} records inserted into {$table}.\e[0m\n";
        } catch (Exception $e) {
            echo "\e[31m❌ Error: {$e->getMessage()}\e[0m\n";
        }
    }
}
