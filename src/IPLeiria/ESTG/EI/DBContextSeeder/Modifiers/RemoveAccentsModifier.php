<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

/**
 * Class RemoveAccentsModifier
 *
 * This modifier removes accents and special characters from a given value,
 * with an option to preserve specific characters.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Modifiers
 */
class RemoveAccentsModifier implements Modifier
{
    /**
     * Characters to ignore during the accent removal (e.g., "_-").
     *
     * @var string
     */
    private string $ignoreCharacters;

    /**
     * Constructor
     *
     * Initializes the modifier with a specified string of characters to ignore during the accent removal process.
     *
     * @param string $ignoreCharacters Characters to ignore during removal (e.g., "_-").
     */
    public function __construct(string $ignoreCharacters = '')
    {
        $this->ignoreCharacters = $ignoreCharacters;
    }

    /**
     * Applies the accent removal transformation to the given value.
     *
     * This method removes accents and special characters, preserving specified characters if provided.
     *
     * @param mixed $value The input value to transform.
     * @return string The version of the input value without accents (except for ignored characters).
     */
    public function apply(mixed $value): string
    {
        $value = (string) $value;

        // Convert to ASCII and remove accents
        $value = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value);

        // Escape and create pattern for ignored characters
        $escapedIgnore = preg_quote($this->ignoreCharacters, '/');
        $pattern = '/[^A-Za-z0-9 ' . $escapedIgnore . ']/';

        // Remove non-ASCII and special characters
        return preg_replace($pattern, '', $value);
    }
}
