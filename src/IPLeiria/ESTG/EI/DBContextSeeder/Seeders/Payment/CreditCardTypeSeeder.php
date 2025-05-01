<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Payment;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class CreditCardTypeSeeder
 *
 * Generates a fake credit card type (e.g., Visa, MasterCard, etc.).
 * Supports generation of unique or non-unique values based on configuration.
 */
class CreditCardTypeSeeder extends FieldSeeder
{
    /**
     * Generate a fake credit card type.
     *
     * If uniqueness is enabled, ensures the value hasn't been generated before.
     *
     * @return string The generated credit card type.
     */
    public function generateValue(): string
    {
        return $this->isUnique()
            ? self::$faker->unique()->creditCardType()
            : self::$faker->creditCardType();
    }
}
