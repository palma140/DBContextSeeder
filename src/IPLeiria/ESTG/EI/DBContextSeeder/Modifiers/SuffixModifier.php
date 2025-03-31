<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

/**
 * Class SuffixModifier
 *
 * A modifier that appends a specified suffix to a given value.
 */
class SuffixModifier implements Modifier
{
    /** @var string The suffix to be appended. */
    protected string $suffix;

    /**
     * SuffixModifier constructor.
     *
     * @param string $suffix The suffix to append to the value.
     */
    public function __construct(string $suffix)
    {
        $this->suffix = $suffix;
    }

    /**
     * Applies the suffix modification to the given value.
     *
     * @param mixed $value The input value.
     * @return string The modified value with the suffix appended.
     */
    public function apply(mixed $value): string
    {
        return $value . $this->suffix;
    }
}
