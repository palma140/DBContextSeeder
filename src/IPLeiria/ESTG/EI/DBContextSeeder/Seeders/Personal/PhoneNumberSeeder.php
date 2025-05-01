<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class PhoneNumberSeeder
 *
 * This class generates random phone numbers using the Faker library.
 * The generated phone number can be either unique or non-unique, based on the configuration.
 */
class PhoneNumberSeeder extends FieldSeeder
{
    /**
     * Generate a random phone number.
     *
     * If `isUnique` is enabled, a unique phone number will be generated.
     * Otherwise, a random phone number will be returned.
     *
     * @return string The generated phone number.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->phoneNumber() : self::$faker->phoneNumber();
    }
}
