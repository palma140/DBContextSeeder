<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

use Illuminate\Support\Facades\DB;
/**
 * Class LookupModifier
 *
 * Performs a lookup on a database table, matching rows based on a custom matcher function,
 * and extracts a value from the matched row using a callback.
 */
class LookupModifier implements RowAwareModifier
{
    /**
     * @var string The database table to search.
     */
    private string $table;

    /**
     * @var \Closure Matcher function that receives ($currentRow, $targetRow) and returns bool indicating a match.
     */
    private \Closure $matcher;

    /**
     * @var \Closure Callback function that receives ($targetRow) and returns the desired value.
     */
    private \Closure $callback;

    /**
     * @var array The rows retrieved from the database table as associative arrays.
     */
    private array $rows;

    /**
     * Constructor.
     *
     * @param string $table The name of the database table to query all rows from.
     * @param \Closure $matcher A function that accepts ($currentRow, $targetRow) and returns true if they match.
     * @param \Closure $callback A function that accepts ($targetRow) and returns the value to extract.
     */
    public function __construct(string $table, \Closure $matcher, \Closure $callback)
    {
        $this->table = $table;
        $this->matcher = $matcher;
        $this->callback = $callback;

        // Fetch all rows from the specified table, converting each to an associative array
        $this->rows = DB::table($table)->get()->map(fn($r) => (array)$r)->all();
    }

    /**
     * Applies the lookup modifier.
     *
     * Iterates over all loaded rows, applies the matcher to find a matching target row,
     * then applies the callback on the matched row to extract a value.
     *
     * @param mixed $value The current value (not used in this implementation).
     * @param array $row The current row to match against.
     * @return mixed|null Returns the value extracted by the callback from the matched row, or null if no match found.
     */
    public function apply($value, array $row): mixed
    {
        foreach ($this->rows as $targetRow) {
            if (($this->matcher)($row, $targetRow)) {
                return ($this->callback)($targetRow);
            }
        }
        return null;
    }
}
