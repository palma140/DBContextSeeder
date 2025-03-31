<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

/**
 * Class TrimModifier
 *
 * A modifier that trims specified characters from the beginning and end of a given value.
 */
class TrimModifier implements Modifier
{
    /** @var string The characters to be trimmed. */
    private string $characters;

    /**
     * TrimModifier constructor.
     *
     * @param string $characters The characters to remove from the start and end of the value.
     */
    public function __construct(string $characters)
    {
        $this->characters = $characters;
    }

    /**
     * Applies the trim modification to the given value.
     *
     * @param mixed $value The input value.
     * @return string The modified value with the specified characters trimmed.
     */
    public function apply(mixed $value): string
    {
        return trim($value, $this->characters);
    }
}
