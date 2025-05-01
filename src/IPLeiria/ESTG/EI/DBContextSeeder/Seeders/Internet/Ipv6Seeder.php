<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Internet;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class Ipv6Seeder
 *
 * A seeder class for generating IPv6 addresses. It extends the `FieldSeeder` class.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Internet
 */
class Ipv6Seeder extends FieldSeeder
{
    /**
     * Generates an IPv6 address.
     *
     * This method generates a unique IPv6 address if the `isUnique()` method returns true,
     * or a regular IPv6 address if it does not.
     *
     * @return string The generated IPv6 address.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->ipv6() : self::$faker->ipv6();
    }
}
