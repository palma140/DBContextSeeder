<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

/**
 * Class PrefixModifier
 *
 * A modifier that prepends a specified prefix to a given value.
 */
class PrefixModifier implements Modifier
{
    /** @var string The prefix to be added to the value. */
    protected string $prefix;

    /**
     * PrefixModifier constructor.
     *
     * @param string $prefix The prefix to prepend to the value.
     */
    public function __construct(string $prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * Applies the prefix modification to the given value.
     *
     * @param mixed $value The input value.
     * @return mixed The value with the prefix applied.
     */
    public function apply(mixed $value): mixed
    {
        return $this->prefix . $value;
    }
}
