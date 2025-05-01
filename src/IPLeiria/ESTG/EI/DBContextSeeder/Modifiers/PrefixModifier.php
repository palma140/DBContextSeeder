<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

/**
 * Class PrefixModifier
 *
 * A modifier that prepends a specified prefix to a given value.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Modifiers
 */
class PrefixModifier implements Modifier
{
    /**
     * The prefix to be added to the value.
     *
     * @var string
     */
    protected string $prefix;

    /**
     * PrefixModifier constructor.
     *
     * Initializes the modifier with a specified prefix to prepend to values.
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
     * This method prepends the specified prefix to the given value.
     *
     * @param mixed $value The input value to which the prefix will be applied.
     * @return string The value with the prefix applied.
     */
    public function apply(mixed $value): string
    {
        return $this->prefix . $value;
    }
}
