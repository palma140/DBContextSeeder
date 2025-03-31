<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class PostcodeSeeder extends FieldSeeder
{
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->postcode() : self::$faker->postcode();
    }
}
