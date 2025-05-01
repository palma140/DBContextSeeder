<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

/**
 * Interface Modifier
 *
 * Defines a contract for modifying field values before they are seeded.
 * Implementing classes must provide their own logic for applying modifications.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Modifiers
 */
interface Modifier
{
    /**
     * Applies a modification to the given value.
     *
     * @param mixed $value The value to be modified.
     * @return mixed The modified value.
     */
    public function apply(mixed $value): mixed;
}
