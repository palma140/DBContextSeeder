<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class LocaleSeeder extends FieldSeeder
{
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->locale() : self::$faker->locale();
    }
}
