<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * LanguageCodeSeeder generates ISO 639-1 language codes using Faker.
 */
class LanguageCodeSeeder extends FieldSeeder
{
    /**
     * Generates a random language code.
     *
     * If uniqueness is required, ensures the generated code is unique in the dataset.
     *
     * @return string A randomly selected ISO 639-1 language code.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->languageCode() : self::$faker->languageCode();
    }
}
