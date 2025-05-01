<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Internet;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class Ipv4Seeder
 *
 * A seeder class for generating IPv4 addresses. It extends the `FieldSeeder` class.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Internet
 */
class Ipv4Seeder extends FieldSeeder
{
    /**
     * Generates an IPv4 address.
     *
     * This method generates a unique IPv4 address if the `isUnique()` method returns true,
     * or a regular IPv4 address if it does not.
     *
     * @return string The generated IPv4 address.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->ipv4() : self::$faker->ipv4();
    }
}
