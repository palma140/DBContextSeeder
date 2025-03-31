<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Internet;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class MacAddressSeeder extends FieldSeeder
{
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->macAddress() : self::$faker->macAddress();
    }
}
