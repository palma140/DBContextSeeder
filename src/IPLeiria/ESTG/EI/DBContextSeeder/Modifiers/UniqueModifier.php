<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

/**
 * Class UniqueModifier
 *
 * A modifier that is intended to ensure uniqueness of a value.
 *
 * Currently, this implementation does not enforce uniqueness.
 */
class UniqueModifier implements Modifier
{
    /**
     * Applies the uniqueness modification to the given value.
     *
     * Note: This implementation does not modify the value.
     *
     * @param mixed $value The input value.
     * @return mixed The unmodified value.
     */
    public function apply(mixed $value): mixed
    {
        return $value;
    }
}
