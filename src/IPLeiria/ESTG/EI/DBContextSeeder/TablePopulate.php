<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder;

use Exception;
use Illuminate\Support\Facades\DB;
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
     * @var TableSeeder $seeder The TableSeeder instance that defines the table and field seeders.
     */
    protected TableSeeder $seeder;

    /**
     * @var \Closure|null $beforeCallback The callback to execute before population.
     */
    protected ?\Closure $beforeCallback = null;

    /**
     * @var \Closure|null $afterCallback The callback to execute after population.
     */
    protected ?\Closure $afterCallback = null;

    /**
     * TablePopulate constructor.
     *
     * @param TableSeeder $seeder The TableSeeder instance that defines the table and its fields.
     */
    public function __construct(TableSeeder $seeder)
    {
        $this->seeder = $seeder;
    }

    /**
     * Registers a callback to execute before the population process.
     *
     * @param callable $callback The callback to execute before population.
     * @return TablePopulate The current instance for method chaining.
     */
    public function before(callable $callback): TablePopulate
    {
        $this->beforeCallback = $callback instanceof \Closure ? $callback : $callback(...);
        return $this;
    }

    /**
     * Registers a callback to execute after the population process.
     *
     * @param callable $callback The callback to execute after population.
     * @return TablePopulate The current instance for method chaining.
     */
    public function after(callable $callback): TablePopulate
    {
        $this->afterCallback = $callback instanceof \Closure ? $callback : $callback(...);
        return $this;
    }

    /**
     * Populates the table with the specified number of records.
     * Data is inserted in batches, with retries on failure.
     *
     * @param int $count The total number of records to insert.
     * @param int $batchSize The number of records to insert per batch (default: 1000).
     * @param int $maxRetries The maximum number of retries in case of failure (default: 1).
     * @param bool $verbose Whether to show verbose error messages (default: false).
     * @throws Exception If population fails after the specified number of retries.
     */
    public function populate(int $count, int $batchSize = 1000, int $maxRetries = 1, bool $verbose = false): void
    {
        if ($this->beforeCallback) {
            ($this->beforeCallback)();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table($this->seeder->getTable())->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        echo "\e[33m⚠️ Table truncated: {$this->seeder->getTable()}.\e[0m\n";

        $fields = $this->seeder->getFields();
        $table = $this->seeder->getTable();
        $inserted = 0;

        while ($inserted < $count) {
            $success = false;
            $attempts = 0;

            $fieldStates = [];
            foreach ($fields as $fieldName => $fieldSeeder) {
                if ($fieldSeeder instanceof SequentionalNumberSeeder) {
                    $fieldStates[$fieldName] = $fieldSeeder->getCurrentNumber();
                }
            }

            while (!$success && $attempts < $maxRetries) {
                $batch = [];

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

                    foreach ($fields as $fieldName => $fieldSeeder) {
                        if (isset($fieldStates[$fieldName]) && $fieldSeeder instanceof SequentionalNumberSeeder) {
                            $fieldSeeder->setCurrentNumber($fieldStates[$fieldName]);
                        }
                    }

                    $error = $verbose ? $e->getMessage() : $this->extractRelevantSqlError($e->getMessage());
                    echo "\e[33m⚠️ Attempt {$attempts} failed: $error\e[0m\n";

                    if ($attempts >= $maxRetries) {
                        echo "\e[31m❌ Max retries reached. Aborting...\e[0m\n";
                        throw new Exception("Failed to insert batch after {$maxRetries} attempts: " . $e->getMessage());
                    }
                }
            }
        }

        if ($this->afterCallback) {
            ($this->afterCallback)();
        }

        echo "\e[32m🎉 Population completed for {$table}" . ($count > 0 ? ": {$count} records inserted" : "") . ".\e[0m\n";
    }

    /**
     * Extracts the relevant SQL error message, removing unnecessary connection details.
     *
     * @param string $message The error message to extract from.
     * @return string The relevant SQL error message.
     */
    private function extractRelevantSqlError(string $message): string
    {
        return preg_replace('/ \(Connection:.*$/', '', $message);
    }

    /**
     * Generates a single row of data based on the field seeders.
     *
     * @param array $fields The field seeders to use for generating the row.
     * @return array The generated row of data.
     */
    private function generateRow(array $fields): array
    {
        $row = [];

        foreach ($fields as $field => $fieldSeeder) {
            $row[$field] = $fieldSeeder->generate($row);
        }
        return $row;
    }

    /**
     * Populates the table with data from a CSV file.
     *
     * @param string $csvPath The path to the CSV file.
     * @param int $batchSize The number of records to insert per batch (default: 1000).
     * @throws Exception If the CSV file is not found or not readable.
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

            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table($this->seeder->getTable())->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            echo "\e[33m⚠️ Table truncated: {$this->seeder->getTable()}.\e[0m\n";

            $csv = Reader::createFromPath($csvPath, 'r');
            $csv->setHeaderOffset(0);

            $table = $this->seeder->getTable();
            $inserted = 0;
            $batch = [];

            foreach ($csv as $record) {
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

            echo "\e[32m🎉 CSV Import Completed! {$inserted} records inserted into {$table}.\e[0m\n";
        } catch (Exception $e) {
            echo "\e[31m❌ Error: {$e->getMessage()}\e[0m\n";
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

            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table($this->seeder->getTable())->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
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

            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table($this->seeder->getTable())->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            echo "\e[33m⚠️ Table truncated: {$this->seeder->getTable()}.\e[0m\n";

            $table = $this->seeder->getTable();
            $inserted = 0;
            $batch = [];

            foreach ($data as $record) {
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
