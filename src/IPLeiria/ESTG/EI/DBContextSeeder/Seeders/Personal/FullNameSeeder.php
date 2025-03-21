<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class FullNameSeeder extends FieldSeeder
{
    public static ?string $lastGeneratedName = null;

    public function generateValue(): string
    {
        self::$lastGeneratedName = $this->unique
            ? self::$faker->unique()->name()
            : self::$faker->name();

        return self::$lastGeneratedName;
    }
}
