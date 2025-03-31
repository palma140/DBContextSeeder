<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Numbers;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class DigitNotNullSeeder extends FieldSeeder
{
    public function generateValue(): int
    {
        return $this->isUnique() ? self::$faker->unique()->randomDigitNotNull() : self::$faker->randomDigitNotNull();
    }
}
