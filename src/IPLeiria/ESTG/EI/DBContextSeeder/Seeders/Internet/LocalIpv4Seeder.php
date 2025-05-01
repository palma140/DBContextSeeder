<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Internet;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class LocalIpv4Seeder
 *
 * A seeder class for generating local IPv4 addresses. It extends the `FieldSeeder` class.
 * This class is specifically designed for generating local (private) IPv4 addresses, often used
 * in internal networks.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Internet
 */
class LocalIpv4Seeder extends FieldSeeder
{
    /**
     * Generates a local IPv4 address.
     *
     * This method generates a unique local IPv4 address if the `isUnique()` method returns true,
     * or a regular local IPv4 address if it does not.
     *
     * @return string The generated local IPv4 address.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->localIpv4() : self::$faker->localIpv4();
    }
}
