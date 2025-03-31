<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Numbers;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class DigitSeeder extends FieldSeeder
{
    protected ?bool $valid = null;

    public function __construct($tableSeeder, $field)
    {
        parent::__construct($tableSeeder, $field);
        $this->valid = !$this->valid;
    }


    public function generateValue(): int
    {
        return $this->isUnique() ? self::$faker->unique()->randomDigit() : self::$faker->randomDigit();
    }
}
