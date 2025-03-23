<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class Sha256Seeder extends FieldSeeder
{
    public function generateValue(): string
    {
        return $this->unique ? self::$faker->unique()->sha256() : self::$faker->sha256();
    }
}
