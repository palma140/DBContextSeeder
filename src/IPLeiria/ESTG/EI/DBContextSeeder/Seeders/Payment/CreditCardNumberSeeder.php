<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Payment;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class CreditCardNumberSeeder extends FieldSeeder
{
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->creditCardNumber() : self::$faker->creditCardNumber();
    }
}
