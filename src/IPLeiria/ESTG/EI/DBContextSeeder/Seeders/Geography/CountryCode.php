<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class CountryCode
 *
 * A seeder class for generating country codes. It extends the `FieldSeeder` class.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography
 */
class CountryCode extends FieldSeeder
{
    /**
     * Generates a country code.
     *
     * This method generates a unique country code if the `isUnique()` method returns true,
     * or a regular country code if it does not.
     *
     * @return string The generated country code.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->countryCode() : self::$faker->countryCode();
    }
}
