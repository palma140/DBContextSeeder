<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Md5Seeder generates random MD5 hash strings using Faker.
 */
class Md5Seeder extends FieldSeeder
{
    /**
     * Generates a random MD5 hash string.
     *
     * If uniqueness is required, ensures the generated MD5 hash is unique in the dataset.
     *
     * @return string A randomly generated MD5 hash.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->md5() : self::$faker->md5();
    }
}
