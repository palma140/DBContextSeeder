<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class CountryCode extends FieldSeeder
{
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->countryCode() : self::$faker->countryCode();
    }
}
