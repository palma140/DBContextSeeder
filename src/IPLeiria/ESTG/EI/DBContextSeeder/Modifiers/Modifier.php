<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Interface Modifier
 *
 * Defines a contract for modifying field values before they are seeded.
 */
interface Modifier
{
    /**
     * Applies a modification to the given value.
     *
     * @param mixed $value The input value to be modified.
     * @return mixed The modified value.
     */
    public function apply(mixed $value): mixed;
}
