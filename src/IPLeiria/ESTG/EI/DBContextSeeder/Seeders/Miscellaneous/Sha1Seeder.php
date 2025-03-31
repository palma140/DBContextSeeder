<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class Sha1Seeder extends FieldSeeder
{
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->sha1() : self::$faker->sha1();
    }
}
