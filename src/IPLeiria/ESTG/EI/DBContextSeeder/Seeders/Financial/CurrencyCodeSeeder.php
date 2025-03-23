<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Financial;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class CurrencyCodeSeeder extends FieldSeeder
{
    public function generateValue(): string
    {
        return $this->unique ? self::$faker->unique()->currencyCode() : self::$faker->currencyCode();
    }
}
