<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use InvalidArgumentException;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

/**
 * Class PasswordSeeder
 *
 * This class generates random passwords within a specified length range
 * using the Faker library.
 */
class PasswordSeeder extends FieldSeeder
{
    /**
     * Minimum length for the generated password.
     *
     * @var int
     */
    protected int $minLength;

    /**
     * Maximum length for the generated password.
     *
     * @var int
     */
    protected int $maxLength;

    /**
     * PasswordSeeder constructor.
     *
     * @param TableSeeder $tableSeeder The table seeder instance.
     * @param String $field The field name to be seeded.
     * @param int $minLength The minimum password length (default is 8).
     * @param int $maxLength The maximum password length (default is 16).
     *
     * @throws InvalidArgumentException If minLength is less than 1 or maxLength is less than minLength.
     */
    public function __construct(TableSeeder $tableSeeder, string $field, int $minLength = 8, int $maxLength = 16)
    {
        parent::__construct($tableSeeder, $field);

        if ($minLength < 1 || $maxLength < $minLength) {
            throw new InvalidArgumentException("Invalid password length range: min=$minLength, max=$maxLength");
        }

        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
    }

    /**
     * Generate a random password within the configured length range.
     *
     * @return string The generated password.
     */
    public function generateValue(): string
    {
        return self::$faker->password($this->minLength, $this->maxLength);
    }
}
