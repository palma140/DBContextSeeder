<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class CitySeeder extends FieldSeeder
{
    public function generateValue() : string
    {
       return $this->isUnique() ? self::$faker->unique()->city() : self::$faker->city();
    }
}
