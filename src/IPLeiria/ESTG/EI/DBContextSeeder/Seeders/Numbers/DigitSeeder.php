<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Numbers;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

/**
 * Class DigitSeeder
 *
 * This class generates a random digit between 0 and 9. The value can be either
 * unique or non-unique, depending on the configuration.
 */
class DigitSeeder extends FieldSeeder
{
    /**
     * Indicates if the value should be valid or not.
     *
     * @var bool|null
     */
    protected ?bool $valid = null;

    /**
     * DigitSeeder constructor.
     *
     * @param TableSeeder $tableSeeder The table seeder instance.
     * @param String $field The field being seeded.
     */
    public function __construct(TableSeeder $tableSeeder, string $field)
    {
        parent::__construct($tableSeeder, $field);
        $this->valid = !$this->valid;
    }

    /**
     * Generate a random digit between 0 and 9.
     *
     * If `isUnique` is enabled, a unique value will be generated. Otherwise,
     * a random digit between 0 and 9 will be returned.
     *
     * @return int The generated random digit.
     */
    public function generateValue(): int
    {
        return $this->isUnique() ? self::$faker->unique()->randomDigit() : self::$faker->randomDigit();
    }
}
