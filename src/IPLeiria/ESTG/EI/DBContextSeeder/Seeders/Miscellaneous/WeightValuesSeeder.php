<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

/**
 * Class WeightValuesSeeder
 *
 * This class allows seeding a field with values based on specified weights.
 * It randomly selects a value from a predefined set of values, with each value
 * having a specific weight that influences its likelihood of being selected.
 */
class WeightValuesSeeder extends FieldSeeder
{
    /**
     * @var array An associative array where keys are the values to be seeded,
     *            and the values are their respective weights (probabilities).
     */
    protected array $weights;

    /**
     * WeightValuesSeeder constructor.
     *
     * @param TableSeeder $tableSeeder The table seeder that invokes this seeder.
     * @param string $field The field to be populated with the weighted value.
     * @param array $weights The array of values with their respective weights.
     */
    public function __construct(TableSeeder $tableSeeder, string $field, array $weights)
    {
        parent::__construct($tableSeeder, $field);
        $this->weights = $weights;
    }

    /**
     * Generate a value for the field based on the specified weights.
     * It calculates a weighted random selection from the available values.
     *
     * @return string The selected value based on its weight.
     */
    public function generateValue(): string
    {
        $totalWeight = array_sum($this->weights);
        $rand = mt_rand(1, $totalWeight);

        foreach ($this->weights as $value => $weight) {
            if ($rand <= $weight) {
                return $value;
            }
            $rand -= $weight;
        }

        return array_key_first($this->weights);
    }
}
