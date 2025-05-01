<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Internet;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class DomainNameSeeder
 *
 * A seeder class for generating domain name values. It extends the `FieldSeeder` class.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Internet
 */
class DomainNameSeeder extends FieldSeeder
{
    /**
     * Generates a domain name value.
     *
     * This method generates a unique domain name if the `isUnique()` method returns true,
     * or a regular domain word if it does not.
     *
     * @return string The generated domain name value.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->domainName() : self::$faker->domainWord();
    }
}
