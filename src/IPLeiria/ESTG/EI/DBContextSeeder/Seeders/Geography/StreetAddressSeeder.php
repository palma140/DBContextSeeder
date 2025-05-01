<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class StreetAddressSeeder
 *
 * A seeder class for generating street address values. It extends the `FieldSeeder` class.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography
 */
class StreetAddressSeeder extends FieldSeeder
{
    /**
     * Generates a street address value.
     *
     * This method generates a unique street address value if the `isUnique()` method returns true,
     * or a regular street address value if it does not.
     *
     * @return string The generated street address value.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->streetAddress() : self::$faker->streetAddress();
    }
}
