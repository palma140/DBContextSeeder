<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Numbers;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class FloatSeeder extends FieldSeeder
{
    protected ?int $nbMaxDecimals = null;
    protected ?int $min = null;
    protected ?int $max = null;

    public function __construct($tableSeeder, $field, ?int $nbMaxDecimals, ?int $min, ?int $max)
    {
        parent::__construct($tableSeeder, $field);
        $this->nbMaxDecimals = $nbMaxDecimals;
        $this->min = $min;
        $this->max = $max;
    }


    public function generateValue(): int
    {
        return $this->unique ? self::$faker->unique()->randomFloat($this->nbMaxDecimals, $this->min, $this->max) : self::$faker->randomFloat($this->nbMaxDecimals, $this->min, $this->max);
    }
}
