<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class StreetNameSeeder
 *
 * A seeder class for generating street name values. It extends the `FieldSeeder` class.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography
 */
class StreetNameSeeder extends FieldSeeder
{
    /**
     * Generates a street name value.
     *
     * This method generates a unique street name value if the `isUnique()` method returns true,
     * or a regular street name value if it does not.
     *
     * @return string The generated street name value.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->streetName() : self::$faker->streetName();
    }
}
