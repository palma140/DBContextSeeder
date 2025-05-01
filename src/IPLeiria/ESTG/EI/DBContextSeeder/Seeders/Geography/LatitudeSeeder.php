<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class LatitudeSeeder
 *
 * A seeder class for generating latitude values. It extends the `FieldSeeder` class.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography
 */
class LatitudeSeeder extends FieldSeeder
{
    /**
     * Generates a latitude value.
     *
     * This method generates a unique latitude value if the `isUnique()` method returns true,
     * or a regular latitude value if it does not.
     *
     * @return string The generated latitude value.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->latitude() : self::$faker->latitude();
    }
}
