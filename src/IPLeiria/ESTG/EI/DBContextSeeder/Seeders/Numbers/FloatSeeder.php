<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Numbers;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

/**
 * Class FloatSeeder
 *
 * This class generates a random float number, with configurable decimal precision
 * and range. The value can be either unique or non-unique, depending on the configuration.
 */
class FloatSeeder extends FieldSeeder
{
    /**
     * The maximum number of decimal places the float can have.
     *
     * @var int|null
     */
    protected ?int $nbMaxDecimals = null;

    /**
     * The minimum value for the generated float.
     *
     * @var int|null
     */
    protected ?int $min = null;

    /**
     * The maximum value for the generated float.
     *
     * @var int|null
     */
    protected ?int $max = null;

    /**
     * FloatSeeder constructor.
     *
     * @param TableSeeder $tableSeeder The table seeder instance.
     * @param String $field The field being seeded.
     * @param int|null $nbMaxDecimals The maximum number of decimal places.
     * @param int|null $min The minimum possible value.
     * @param int|null $max The maximum possible value.
     */
    public function __construct(TableSeeder $tableSeeder, string $field, ?int $nbMaxDecimals, ?int $min, ?int $max)
    {
        parent::__construct($tableSeeder, $field);
        $this->nbMaxDecimals = $nbMaxDecimals;
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * Generate a random float within the specified range and precision.
     *
     * If `isUnique` is enabled, a unique float will be generated. Otherwise,
     * a random float between the given min and max values will be returned.
     *
     * @return float The generated random float.
     */
    public function generateValue(): float
    {
        return $this->isUnique()
            ? self::$faker->unique()->randomFloat($this->nbMaxDecimals, $this->min, $this->max)
            : self::$faker->randomFloat($this->nbMaxDecimals, $this->min, $this->max);
    }
}
