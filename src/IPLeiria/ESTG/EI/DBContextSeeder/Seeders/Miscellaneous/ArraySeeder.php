<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

/**
 * Class ArraySeeder
 *
 * A seeder class that generates values from a provided array of possible values.
 * It supports both ordered and random value selection. If ordered selection is enabled,
 * the values will be used in sequence, cycling through the array.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous
 */
class ArraySeeder extends FieldSeeder
{
    /**
     * @var array The list of possible values to be returned.
     */
    protected array $values;

    /**
     * @var bool Whether to use ordered values (cycle through the list) or not.
     */
    protected bool $useOrderedValues;

    /**
     * @var int The current index when using ordered values.
     */
    protected int $currentIndex = 0;

    /**
     * ArraySeeder constructor.
     *
     * @param TableSeeder $tableSeeder The table seeder instance.
     * @param string $field The field being seeded.
     * @param array $values The array of possible values to choose from.
     * @param bool $useOrderedValues Whether to use ordered values (cycling through the array).
     */
    public function __construct(TableSeeder $tableSeeder, string $field, array $values = [], bool $useOrderedValues = false)
    {
        parent::__construct($tableSeeder, $field);
        $this->values = $values;
        $this->useOrderedValues = $useOrderedValues;
    }

    /**
     * Generates a value from the list of possible values.
     *
     * If ordered values are enabled, the function will cycle through the values in sequence.
     * If random selection is preferred, it returns a random value from the array, ensuring uniqueness if required.
     *
     * @return mixed A value selected from the array.
     */
    public function generateValue(): mixed
    {
        if ($this->useOrderedValues) {
            if ($this->currentIndex >= count($this->values)) {
                $this->currentIndex = 0;
            }
            return $this->values[$this->currentIndex++];
        }

        return $this->isUnique()
            ? self::$faker->unique()->randomElement($this->values)
            : self::$faker->randomElement($this->values);
    }
}
