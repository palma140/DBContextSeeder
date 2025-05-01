<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class PostcodeSeeder
 *
 * A seeder class for generating postcode values. It extends the `FieldSeeder` class.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography
 */
class PostcodeSeeder extends FieldSeeder
{
    /**
     * Generates a postcode value.
     *
     * This method generates a unique postcode value if the `isUnique()` method returns true,
     * or a regular postcode value if it does not.
     *
     * @return string The generated postcode value.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->postcode() : self::$faker->postcode();
    }
}
