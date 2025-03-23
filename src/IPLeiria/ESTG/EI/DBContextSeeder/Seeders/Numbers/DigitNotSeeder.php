<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Numbers;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class DigitNotSeeder extends FieldSeeder
{
    protected ?int $value = null;

    public function __construct($tableSeeder, $field, $value)
    {
        parent::__construct($tableSeeder, $field);
        $this->$value = $value;
    }


    public function generateValue(): int
    {
        return $this->unique ? self::$faker->unique()->randomDigitNot($this->value) : self::$faker->randomDigitNot($this->value);
    }
}
