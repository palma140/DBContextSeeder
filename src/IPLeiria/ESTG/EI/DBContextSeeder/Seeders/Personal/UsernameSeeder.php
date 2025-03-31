<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class UsernameSeeder extends FieldSeeder
{
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->userName() : self::$faker->userName();
    }
}
