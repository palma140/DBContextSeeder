<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Text;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

/**
 * Class TextSeeder
 *
 * Generates random text data for a specified field with a maximum character length.
 * Supports generating unique text values if required.
 */
class TextSeeder extends FieldSeeder
{
    /**
     * @var int Maximum number of characters for the generated text.
     */
    protected int $maxCharacters;

    /**
     * Constructor.
     *
     * @param TableSeeder $tableSeeder The parent table seeder.
     * @param string $field The database field this seeder applies to.
     * @param int $maxCharacters Maximum length of the generated text.
     */
    public function __construct(TableSeeder $tableSeeder, string $field, $maxCharacters)
    {
        parent::__construct($tableSeeder, $field);
        $this->maxCharacters = $maxCharacters;
    }

    /**
     * Generates a text value for the current field.
     * Returns unique text if the seeder is marked unique, otherwise random text.
     *
     * @return string Generated text value.
     */
    public function generateValue(): string
    {
        return $this->isUnique()
            ? self::$faker->unique()->text($this->maxCharacters)
            : self::$faker->text($this->maxCharacters);
    }
}
