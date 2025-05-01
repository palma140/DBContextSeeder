<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Numbers;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

/**
 * Class NumberBetweenSeeder
 *
 * This class generates a random integer between a specified minimum and maximum value.
 * The generated number can be either unique or non-unique, based on the configuration.
 */
class NumberBetweenSeeder extends FieldSeeder
{
    /**
     * The minimum value for the generated number.
     *
     * @var int|null
     */
    protected ?int $min = null;

    /**
     * The maximum value for the generated number.
     *
     * @var int|null
     */
    protected ?int $max = null;

    /**
     * NumberBetweenSeeder constructor.
     *
     * @param TableSeeder $tableSeeder The table seeder instance.
     * @param String $field The field being seeded.
     * @param int|null $min The minimum possible value.
     * @param int|null $max The maximum possible value.
     */
    public function __construct(TableSeeder $tableSeeder, string $field, ?int $min, ?int $max)
    {
        parent::__construct($tableSeeder, $field);
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * Generate a random integer between the specified minimum and maximum values.
     *
     * If `isUnique` is enabled, a unique number will be generated. Otherwise,
     * a random number between the min and max values will be returned.
     *
     * @return int The generated random number.
     */
    public function generateValue(): int
    {
        // Generate a unique or non-unique random number between min and max
        return $this->isUnique()
            ? self::$faker->unique()->numberBetween($this->min, $this->max)
            : self::$faker->numberBetween($this->min, $this->max);
    }
}
