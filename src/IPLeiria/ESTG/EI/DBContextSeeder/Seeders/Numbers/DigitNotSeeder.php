<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Numbers;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

/**
 * Class DigitNotSeeder
 *
 * This class generates a random digit between 0 and 9, but excludes a specific value
 * that is passed as a parameter. The generated value can be either unique or not,
 * depending on the configuration.
 */
class DigitNotSeeder extends FieldSeeder
{
    /**
     * The value to be excluded from the generated random digits.
     *
     * @var int|null
     */
    protected ?int $value = null;

    /**
     * DigitNotSeeder constructor.
     *
     * @param TableSeeder $tableSeeder The table seeder instance.
     * @param String $field The field being seeded.
     * @param int|null $value The digit to exclude from the possible values.
     */
    public function __construct(TableSeeder $tableSeeder, string $field, ?int $value)
    {
        parent::__construct($tableSeeder, $field);
        $this->value = $value;
    }

    /**
     * Generate a random digit between 0 and 9, excluding the provided value.
     *
     * If `isUnique` is enabled, a unique value will be generated. Otherwise,
     * a random digit excluding the specified value will be returned.
     *
     * @return int The generated digit, excluding the specified value.
     */
    public function generateValue(): int
    {
        return $this->isUnique() ? self::$faker->unique()->randomDigitNot($this->value) : self::$faker->randomDigitNot($this->value);
    }
}
