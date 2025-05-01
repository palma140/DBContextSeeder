<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Numbers;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

/**
 * Class NumberSeeder
 *
 * This class generates a random number with a specified number of digits.
 * The generated number can be either unique or non-unique, based on the configuration.
 */
class NumberSeeder extends FieldSeeder
{
    /**
     * The number of digits for the generated number.
     *
     * @var int|null
     */
    protected ?int $nbDigits = null;

    /**
     * Whether the generated number should be strict or not (non-zero first digit).
     *
     * @var bool|null
     */
    protected ?bool $strict = null;

    /**
     * NumberSeeder constructor.
     *
     * @param TableSeeder $tableSeeder The table seeder instance.
     * @param String $field The field being seeded.
     * @param int|null $nbDigits The number of digits for the generated number.
     * @param bool|null $strict Whether to apply strict constraints on the first digit.
     */
    public function __construct(TableSeeder $tableSeeder, string $field, ?int $nbDigits, ?bool $strict)
    {
        parent::__construct($tableSeeder, $field);
        $this->nbDigits = $nbDigits;
        $this->strict = $strict;
    }

    /**
     * Generate a random number with the specified number of digits.
     *
     * If `isUnique` is enabled, a unique number will be generated. Otherwise,
     * a random number with the specified number of digits and strictness is returned.
     *
     * @return int The generated random number.
     */
    public function generateValue(): int
    {
        return $this->isUnique()
            ? self::$faker->unique()->randomNumber($this->nbDigits, $this->strict)
            : self::$faker->randomNumber($this->nbDigits, $this->strict);
    }
}
