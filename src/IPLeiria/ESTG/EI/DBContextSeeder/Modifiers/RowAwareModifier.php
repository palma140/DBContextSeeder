<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

/**
 * Interface RowAwareModifier
 *
 * Defines a contract for modifying field values before they are seeded, with awareness of the current row.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Modifiers
 */
interface RowAwareModifier
{
    /**
     * Applies a modification to the given value, taking into account the current row.
     *
     * @param mixed $value The input value to be modified.
     * @param array $row The current row being processed.
     * @return mixed The modified value based on the row context.
     */
    public function apply(mixed $value, array $row): mixed;
}
