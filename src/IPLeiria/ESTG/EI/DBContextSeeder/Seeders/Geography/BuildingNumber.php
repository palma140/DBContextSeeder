<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class BuildingNumber
 *
 * A seeder class for generating building numbers. It extends the `FieldSeeder` class.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography
 */
class BuildingNumber extends FieldSeeder
{
    /**
     * Generates a building number.
     *
     * This method generates a unique building number if the `isUnique()` method returns true,
     * or a regular building number if it does not.
     *
     * @return string The generated building number.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->buildingNumber() : self::$faker->buildingNumber();
    }
}
