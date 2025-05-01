<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use Exception;
use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;
use League\Csv\Reader;

/**
 * CsvSeeder generates fake data using values from a specified column in a CSV file.
 */
class CsvSeeder extends FieldSeeder
{
    /**
     * The path to the CSV file.
     *
     * @var string
     */
    protected string $csvFile;

    /**
     * The name of the column from which to extract values.
     *
     * @var string
     */
    protected string $targetCsvColumn;

    /**
     * The array of values loaded from the target CSV column.
     *
     * @var array
     */
    protected array $values = [];

    /**
     * CsvSeeder constructor.
     *
     * @param TableSeeder  $tableSeeder      Reference to the parent TableSeeder.
     * @param string $field            The field name this seeder will populate.
     * @param string $csvFile          Path to the CSV file.
     * @param string $targetCsvColumn  Column name to read values from.
     *
     * @throws Exception If the file or column is invalid.
     */
    public function __construct(TableSeeder $tableSeeder, string $field, string $csvFile, string $targetCsvColumn)
    {
        parent::__construct($tableSeeder, $field);
        $this->csvFile = $csvFile;
        $this->targetCsvColumn = $targetCsvColumn;
        $this->loadCsvData();
    }

    /**
     * Loads data from the specified CSV file and populates the $values array.
     *
     * @throws Exception If the file is empty or the column is not found.
     */
    protected function loadCsvData(): void
    {
        $csv = Reader::createFromPath($this->csvFile);
        $csv->setHeaderOffset(0); // Use the first row as header

        $records = iterator_to_array($csv->getRecords());

        if (empty($records)) {
            throw new Exception("The CSV file '{$this->csvFile}' is empty or could not be read.");
        }

        $firstRecord = reset($records);
        if (!array_key_exists($this->targetCsvColumn, $firstRecord)) {
            throw new Exception("Column '{$this->targetCsvColumn}' not found in file '{$this->csvFile}'.");
        }

        $this->values = array_map(fn($record) => $record[$this->targetCsvColumn], $records);
    }

    /**
     * Generates a value from the loaded CSV column data.
     *
     * @return string A randomly selected value from the CSV data.
     *
     * @throws Exception If no values were loaded from the CSV file.
     */
    public function generateValue(): string
    {
        if (empty($this->values)) {
            throw new Exception("No values loaded from CSV file '{$this->csvFile}'.");
        }

        return $this->isUnique()
            ? self::$faker->unique()->randomElement($this->values)
            : self::$faker->randomElement($this->values);
    }
}
