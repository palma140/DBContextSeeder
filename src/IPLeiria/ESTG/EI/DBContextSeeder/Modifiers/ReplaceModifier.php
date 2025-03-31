<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

/**
 * Class ReplaceModifier
 *
 * A modifier that replaces occurrences of a specified substring within a value.
 */
class ReplaceModifier implements Modifier
{
    /** @var string The substring to search for. */
    protected string $search;

    /** @var string The replacement substring. */
    protected string $replace;

    /**
     * ReplaceModifier constructor.
     *
     * @param string $search The substring to be replaced.
     * @param string $replace The replacement string.
     */
    public function __construct(string $search, string $replace)
    {
        $this->search = $search;
        $this->replace = $replace;
    }

    /**
     * Applies the replacement modification to the given value.
     *
     * @param mixed $value The input value.
     * @return mixed The modified value with replacements applied.
     */
    public function apply(mixed $value): mixed
    {
        return str_replace($this->search, $this->replace, $value);
    }
}
