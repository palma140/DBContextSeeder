<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use Illuminate\Support\Facades\DB;
use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use InvalidArgumentException;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

/**
 * Class SqlSeeder
 *
 * This class allows seeding values for a field from a SQL query result.
 * It executes a query, retrieves a single column of data, and uses those values
 * to populate the field. The values are cached for performance.
 *
 * Optionally, it supports preserving the exact order of the SQL result set.
 */
class SqlSeeder extends FieldSeeder
{
    /**
     * @var string The SQL query string to execute.
     */
    protected string $query;

    /**
     * @var array The parameters to bind to the SQL query.
     */
    protected array $bindings;

    /**
     * @var array|null Cached values from the SQL query result.
     */
    protected ?array $cachedValues = null;

    /**
     * @var bool Whether to preserve the order of SQL results when seeding.
     */
    protected bool $preserveOrder = false;

    /**
     * @var int Current index used when preserving order.
     */
    protected int $currentIndex = 0;

    /**
     * SqlSeeder constructor.
     *
     * @param TableSeeder $tableSeeder The table seeder that invokes this seeder.
     * @param string $field The field to be populated with generated values.
     * @param string $query The SQL query to fetch values from the database.
     * @param array $bindings The bindings for the SQL query.
     * @param bool $preserveOrder Whether to preserve the order of SQL results (default false).
     *
     * @throws InvalidArgumentException if the query is invalid (does not select only one column).
     */
    public function __construct(
        TableSeeder $tableSeeder,
        string $field,
        string $query,
        array $bindings = [],
        bool $preserveOrder = false
    ) {
        parent::__construct($tableSeeder, $field);

        if (!$this->isValidQuery($query, $bindings)) {
            throw new InvalidArgumentException("The query must select only one column, e.g., 'SELECT id FROM table'.");
        }

        $this->query = $query;
        $this->bindings = $bindings;
        $this->preserveOrder = $preserveOrder;
    }

    /**
     * Generate a value by executing the SQL query and selecting a value from the result.
     * - If `preserveOrder` is true, returns the next value in sequence.
     * - Otherwise, selects a random value (optionally unique).
     *
     * @return mixed A value from the query result.
     *
     * @throws \RuntimeException if no more values are available in order-preserving mode.
     */
    protected function generateValue(): mixed
    {
        if ($this->cachedValues === null) {
            $result = DB::select($this->query, $this->bindings);

            if (empty($result)) {
                $this->cachedValues = [];
            } else {
                $column = array_key_first((array) $result[0]);
                $this->cachedValues = array_map(fn($row) => $row->$column, $result);
            }
        }

        if ($this->preserveOrder) {
            if (!isset($this->cachedValues[$this->currentIndex])) {
                throw new \RuntimeException("No more values available for SQL seeder (preserveOrder = true).");
            }

            return $this->cachedValues[$this->currentIndex++];
        }

        return $this->isUnique()
            ? self::$faker->unique()->randomElement($this->cachedValues)
            : self::$faker->randomElement($this->cachedValues);
    }

    /**
     * Validate the SQL query to ensure it selects exactly one column.
     *
     * @param string $query The SQL query string.
     * @param array $bindings The parameters to bind to the SQL query.
     *
     * @return bool True if the query selects exactly one column, false otherwise.
     */
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
