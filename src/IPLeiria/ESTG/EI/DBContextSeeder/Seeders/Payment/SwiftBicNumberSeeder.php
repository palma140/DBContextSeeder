<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Payment;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class SwiftBicNumberSeeder
 *
 * Generates a SWIFT/BIC number for a financial institution.
 * The generated value can be unique or not, depending on the configuration.
 */
class SwiftBicNumberSeeder extends FieldSeeder
{
    /**
     * Generate a SWIFT/BIC number.
     *
     * If uniqueness is enabled, ensures the number hasn't been generated before.
     *
     * @return string The generated SWIFT/BIC number.
     */
    public function generateValue(): string
    {
        return $this->isUnique()
            ? self::$faker->unique()->swiftBicNumber()
            : self::$faker->swiftBicNumber();
    }
}
