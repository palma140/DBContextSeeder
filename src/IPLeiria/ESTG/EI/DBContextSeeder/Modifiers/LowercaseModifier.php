<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

/**
 * Class LowercaseModifier
 *
 * This modifier converts a given value to lowercase.
 */
class LowercaseModifier implements Modifier
{
    /**
     * Applies the lowercase transformation to the given value.
     *
     * @param mixed $value The input value to be converted to lowercase.
     * @return string The lowercase version of the input value.
     */
    public function apply(mixed $value): string
    {
        return strtolower($value);
    }
}
