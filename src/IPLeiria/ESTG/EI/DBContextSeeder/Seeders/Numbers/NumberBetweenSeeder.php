<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Numbers;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class NumberBetweenSeeder extends FieldSeeder
{
    protected ?int $min = null;
    protected ?int $max = null;

    public function __construct($tableSeeder, $field, ?int $min, ?int $max)
    {
        parent::__construct($tableSeeder, $field);
        $this->min = $min;
        $this->max = $max;
    }

    public function generateValue(): int
    {
        return $this->isUnique() ? self::$faker->unique()->numberBetween($this->min, $this->max) : self::$faker->randomNumber($this->min, $this->max);
    }
}
