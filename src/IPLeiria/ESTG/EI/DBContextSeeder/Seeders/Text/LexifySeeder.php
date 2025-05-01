<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Text;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

/**
 * Class LexifySeeder
 *
 * This class generates a random string based on a pattern, replacing `?` in the pattern
 * with random letters. This can be useful for generating randomized alphanumeric strings.
 */
class LexifySeeder extends FieldSeeder
{
    /**
     * The pattern to generate the string.
     *
     * @var string
     */
    protected string $pattern;

    /**
     * LexifySeeder constructor.
     *
     * @param TableSeeder $tableSeeder The table seeder instance.
     * @param String $field The field being seeded.
     * @param string $pattern The pattern to replace with random letters.
     */
    public function __construct(TableSeeder $tableSeeder, string $field, string $pattern)
    {
        parent::__construct($tableSeeder, $field);
        $this->pattern = $pattern;
    }

    /**
     * Generate a random string based on the pattern.
     *
     * This method replaces each `?` in the pattern with a random letter.
     *
     * @return string The generated random string.
     */
    public function generateValue(): string
    {
        return self::$faker->lexify($this->pattern);
    }
}
