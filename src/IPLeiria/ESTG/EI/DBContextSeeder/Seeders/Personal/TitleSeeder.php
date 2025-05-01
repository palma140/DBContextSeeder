<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class TitleSeeder
 *
 * This class generates random titles (e.g., Mr., Mrs., Dr., etc.) using the Faker library.
 * The generated title can be either unique or non-unique, based on the configuration.
 */
class TitleSeeder extends FieldSeeder
{
    /**
     * Generate a random title.
     *
     * If `isUnique` is enabled, a unique title will be generated.
     * Otherwise, a random title will be returned.
     *
     * @return string The generated title.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->title() : self::$faker->title();
    }
}
