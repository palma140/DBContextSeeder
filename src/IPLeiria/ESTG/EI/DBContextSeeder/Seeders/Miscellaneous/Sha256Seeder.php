<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Sha256Seeder generates SHA-256 hash values.
 */
class Sha256Seeder extends FieldSeeder
{
    /**
     * Generates a unique or non-unique SHA-256 hash value.
     *
     * @return string AN SHA-256 hash string.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->sha256() : self::$faker->sha256();
    }
}
