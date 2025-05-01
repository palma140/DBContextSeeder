<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class CitySeeder
 *
 * A seeder class for generating city names. It extends the `FieldSeeder` class.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography
 */
class CitySeeder extends FieldSeeder
{
    /**
     * Generates a city name.
     *
     * This method generates a unique city name if the `isUnique()` method returns true,
     * or a regular city name if it does not.
     *
     * @return string The generated city name.
     */
    public function generateValue() : string
    {
        return $this->isUnique() ? self::$faker->unique()->city() : self::$faker->city();
    }
}
