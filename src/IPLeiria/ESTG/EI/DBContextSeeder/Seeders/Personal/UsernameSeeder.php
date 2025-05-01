<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class UsernameSeeder
 *
 * This class generates random usernames using the Faker library.
 * The generated username can be either unique or non-unique, based on the configuration.
 */
class UsernameSeeder extends FieldSeeder
{
    /**
     * Generate a random username.
     *
     * If `isUnique` is enabled, a unique username will be generated.
     * Otherwise, a random username will be returned.
     *
     * @return string The generated username.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->userName() : self::$faker->userName();
    }
}
