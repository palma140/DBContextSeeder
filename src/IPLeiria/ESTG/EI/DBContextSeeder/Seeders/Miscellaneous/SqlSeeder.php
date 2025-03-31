<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use Illuminate\Support\Facades\DB;
use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use InvalidArgumentException;

class SqlSeeder extends FieldSeeder
{
    protected string $query;
    protected array $bindings;
    protected static array $usedValues = [];


    public function __construct($tableSeeder, $field, string $query, array $bindings = [])
    {
        parent::__construct($tableSeeder, $field);

        if (!$this->isValidQuery($query, $bindings)) {
            throw new InvalidArgumentException("The query must select only one column, e.g., 'SELECT id FROM table'.");
        }

        $this->query = $query;
        $this->bindings = $bindings;
    }

    protected function generateValue(): mixed
    {
        $result = DB::select($this->query, $this->bindings);

        if (empty($result)) {
            return [];
        }

        $column = array_key_first((array) $result[0]);

        $values = array_map(fn($row) => $row->$column, $result);

        return $this->isUnique()
            ? self::$faker->unique()->randomElement($values)
            : self::$faker->randomElement($values);
    }


    private function isValidQuery(string $query, array $bindings): bool
    {
        try {
            $result = DB::select($query, $bindings);

            if (!empty($result)) {
                $firstRow = (array) $result[0];

                return count($firstRow) === 1;
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
