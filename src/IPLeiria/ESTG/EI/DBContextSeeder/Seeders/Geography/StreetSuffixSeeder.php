<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class StreetSuffixSeeder
 *
 * A seeder class for generating street suffix values. It extends the `FieldSeeder` class.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography
 */
class StreetSuffixSeeder extends FieldSeeder
{
    /**
     * Generates a street suffix value.
     *
     * This method generates a unique street suffix value if the `isUnique()` method returns true,
     * or a regular street suffix value if it does not.
     *
     * @return string The generated street suffix value.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->streetSuffix() : self::$faker->streetSuffix();
    }
}
