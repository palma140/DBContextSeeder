<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Internet;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class MacAddressSeeder
 *
 * A seeder class for generating MAC addresses. It extends the `FieldSeeder` class.
 * This class is specifically designed for generating MAC addresses, which are used
 * to uniquely identify network devices on a local network.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Internet
 */
class MacAddressSeeder extends FieldSeeder
{
    /**
     * Generates a MAC address.
     *
     * This method generates a unique MAC address if the `isUnique()` method returns true,
     * or a regular MAC address if it does not.
     *
     * @return string The generated MAC address.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->macAddress() : self::$faker->macAddress();
    }
}
