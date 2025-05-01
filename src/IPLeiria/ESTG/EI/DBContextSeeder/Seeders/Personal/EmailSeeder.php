<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class EmailSeeder
 *
 * Generates a random email address.
 * The generated email can be either unique or non-unique, based on the configuration.
 */
class EmailSeeder extends FieldSeeder
{
    /**
     * Generate a random email address.
     *
     * If uniqueness is enabled, ensures the email hasn't been generated before.
     *
     * @return string The generated email address.
     */
    public function generateValue(): string
    {
        return $this->isUnique()
            ? self::$faker->unique()->email()
            : self::$faker->email();
    }
}
