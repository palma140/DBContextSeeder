<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

/**
 * Class UppercaseModifier
 *
 * A modifier that converts a given value to uppercase.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Modifiers
 */
class UppercaseModifier implements Modifier
{
    /**
     * Applies the uppercase transformation to the given value.
     *
     * This method takes the input value and returns its uppercase version.
     *
     * @param mixed $value The input value.
     * @return string The transformed value in uppercase.
     */
    public function apply(mixed $value): string
    {
        return strtoupper($value);
    }
}
