<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Numbers;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class DigitNotNullSeeder
 *
 * This class is responsible for generating a random digit (0-9) that is guaranteed
 * to be not null (i.e., the digit will not be 0).
 * The digit can be generated either as unique or not, depending on the configuration.
 */
class DigitNotNullSeeder extends FieldSeeder
{
    /**
     * Generate a random non-zero digit (1-9).
     *
     * If the `isUnique` method is enabled, it generates a unique non-zero digit.
     * Otherwise, it generates a random non-zero digit.
     *
     * @return int The generated non-zero digit (1-9).
     */
    public function generateValue(): int
    {
        // Generate a unique or non-unique random non-zero digit
        return $this->isUnique() ? self::$faker->unique()->randomDigitNotNull() : self::$faker->randomDigitNotNull();
    }
}
