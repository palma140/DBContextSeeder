<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Numbers;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class NumberSeeder extends FieldSeeder
{
    protected ?int $nbDigits = null;
    protected ?bool $strict = null;

    public function __construct($tableSeeder, $field, ?int $nbDigits, ?bool $strict)
    {
        parent::__construct($tableSeeder, $field);
        $this->nbDigits = $nbDigits;
        $this->strict = $strict;
    }


    public function generateValue(): int
    {
        return $this->isUnique() ? self::$faker->unique()->randomNumber($this->nbDigits, $this->strict) : self::$faker->randomNumber($this->nbDigits, $this->strict);
    }
}
