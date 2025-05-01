<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Text;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

/**
 * Class BothifySeeder
 *
 * This class generates a random string based on a provided pattern, where placeholders
 * (e.g., `?`, `#`, etc.) are replaced with random letters and numbers.
 */
class BothifySeeder extends FieldSeeder
{
    /**
     * The pattern to be used for generating the string.
     * The pattern can include placeholders like `?` for a letter and `#` for a digit.
     *
     * @var string
     */
    protected string $pattern;

    /**
     * BothifySeeder constructor.
     *
     * @param TableSeeder $tableSeeder The table seeder instance.
     * @param String $field The field being seeded.
     * @param string $pattern The pattern to generate the string (e.g., '??-###').
     */
    public function __construct(TableSeeder $tableSeeder, string $field, string $pattern)
    {
        parent::__construct($tableSeeder, $field);
        $this->pattern = $pattern;
    }

    /**
     * Generate a random string based on the provided pattern.
     *
     * This method replaces placeholders in the pattern with random letters or digits.
     * For example, the pattern '??-###' might generate 'ab-123'.
     *
     * @return string The generated string.
     */
    public function generateValue(): string
    {
        return self::$faker->bothify($this->pattern);
    }
}
