<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Payment;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class CreditCardTypeSeeder extends FieldSeeder
{
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->creditCardType() : self::$faker->creditCardType();
    }
}
