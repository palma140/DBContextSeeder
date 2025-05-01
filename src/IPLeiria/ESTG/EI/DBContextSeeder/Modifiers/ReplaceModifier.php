<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

/**
 * Class ReplaceModifier
 *
 * A modifier that replaces occurrences of a specified substring within a value.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Modifiers
 */
class ReplaceModifier implements Modifier
{
    /**
     * The substring to search for and replace.
     *
     * @var string
     */
    protected string $search;

    /**
     * The replacement substring.
     *
     * @var string
     */
    protected string $replace;

    /**
     * ReplaceModifier constructor.
     *
     * Initializes the modifier with a substring to search for and a replacement string.
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
     * This method searches for occurrences of the `search` substring in the input `value` and replaces them with the `replace` string.
     *
     * @param mixed $value The input value in which the replacement will occur.
     * @return mixed The modified value with the specified replacements applied.
     */
    public function apply(mixed $value): mixed
    {
        return str_replace($this->search, $this->replace, $value);
    }
}
