<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class LongitudeSeeder
 *
 * A seeder class for generating longitude values. It extends the `FieldSeeder` class.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography
 */
class LongitudeSeeder extends FieldSeeder
{
    /**
     * Generates a longitude value.
     *
     * This method generates a unique longitude value if the `isUnique()` method returns true,
     * or a regular longitude value if it does not.
     *
     * @return string The generated longitude value.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->longitude() : self::$faker->longitude();
    }
}
