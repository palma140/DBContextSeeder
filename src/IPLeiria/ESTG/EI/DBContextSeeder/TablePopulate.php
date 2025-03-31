<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class TablePopulate
 *
 * This class is responsible for populating a database table using a given TableSeeder.
 */
class TablePopulate
{
    /** @var TableSeeder The seeder instance used to generate table data */
    protected TableSeeder $seeder;

    /**
     * TablePopulate constructor.
     *
     * @param TableSeeder $seeder The seeder instance to use for data generation.
     */
    public function __construct(TableSeeder $seeder)
    {
        $this->seeder = $seeder;
    }

    /**
     * Populates the table with a given number of records.
     *
     * @param int $count The total number of records to insert.
     * @param int $batchSize The number of records to insert per batch (default: 1000).
     *
     * @return void
     */
    public function populate(int $count, int $batchSize = 1000): void
    {
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table($this->seeder->getTable())->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            echo "\e[33m⚠️ Table truncated: {$this->seeder->getTable()}.\e[0m\n";

            $fields = $this->seeder->getFields();
            $table = $this->seeder->getTable();
            $inserted = 0;

            while ($inserted < $count) {
                $batch = [];

                for ($i = 0; $i < min($batchSize, $count - $inserted); $i++) {
                    $batch[] = array_map(fn($fieldSeeder) => $fieldSeeder->generate(), $fields);
                }

                DB::table($table)->insert($batch);
                $inserted += count($batch);

                echo "\e[32m✅ Inserted {$inserted}/{$count} records into {$table}...\e[0m\n";
            }

            echo "\e[32m🎉 Population completed! {$inserted} records inserted into {$table}.\e[0m\n";
        } catch (\Exception $e) {
            echo "\e[31m❌ Error: {$e->getMessage()}\e[0m\n";
        }
    }
}
