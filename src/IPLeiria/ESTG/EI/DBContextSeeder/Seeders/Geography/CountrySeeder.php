<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class CountrySeeder
 *
 * A seeder class for generating country names. It extends the `FieldSeeder` class.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography
 */
class CountrySeeder extends FieldSeeder
{
    /**
     * Generates a country name.
     *
     * This method generates a unique country name if the `isUnique()` method returns true,
     * or a regular country name if it does not.
     *
     * @return string The generated country name.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->country() : self::$faker->country();
    }
}
