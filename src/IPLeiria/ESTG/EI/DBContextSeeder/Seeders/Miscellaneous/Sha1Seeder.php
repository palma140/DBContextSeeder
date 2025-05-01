<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Sha1Seeder generates SHA-1 hash values.
 */
class Sha1Seeder extends FieldSeeder
{
    /**
     * Generates a unique or non-unique SHA-1 hash value.
     *
     * @return string AN SHA-1 hash string.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->sha1() : self::$faker->sha1();
    }
}
