<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class BuildingNumber extends FieldSeeder
{
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->buildingNumber() : self::$faker->buildingNumber();
    }
}
