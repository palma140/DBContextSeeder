<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Payment;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class CreditCardNumberSeeder
 *
 * Generates a fake credit card number.
 * Supports generation of unique or non-unique values based on configuration.
 */
class CreditCardNumberSeeder extends FieldSeeder
{
    /**
     * Generate a fake credit card number.
     *
     * If uniqueness is enabled, ensures the value hasn't been generated before.
     *
     * @return string The generated credit card number.
     */
    public function generateValue(): string
    {
        return $this->isUnique()
            ? self::$faker->unique()->creditCardNumber()
            : self::$faker->creditCardNumber();
    }
}
