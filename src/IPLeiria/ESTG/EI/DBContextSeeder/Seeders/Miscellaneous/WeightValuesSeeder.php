<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class WeightValuesSeeder extends FieldSeeder
{
    protected array $weights;

    public function __construct($tableSeeder, string $field, array $weights)
    {
        parent::__construct($tableSeeder, $field);
        $this->weights = $weights;
    }

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
