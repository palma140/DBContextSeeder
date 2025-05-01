<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class AddressSeeder
 *
 * A seeder class for generating addresses. It extends the `FieldSeeder` class.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography
 */
class AddressSeeder extends FieldSeeder
{
    /**
     * Generates an address.
     *
     * This method generates a unique address if the `isUnique()` method returns true,
     * or a regular address if it does not.
     *
     * @return string The generated address.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->address() : self::$faker->address();
    }
}
