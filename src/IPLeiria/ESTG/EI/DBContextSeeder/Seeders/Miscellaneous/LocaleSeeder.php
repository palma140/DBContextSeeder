<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * LocaleSeeder generates random locale strings using Faker.
 */
class LocaleSeeder extends FieldSeeder
{
    /**
     * Generates a random locale string (e.g., en_US, pt_PT).
     *
     * If uniqueness is required, ensures the generated locale is unique in the dataset.
     *
     * @return string A randomly selected locale identifier.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->locale() : self::$faker->locale();
    }
}
