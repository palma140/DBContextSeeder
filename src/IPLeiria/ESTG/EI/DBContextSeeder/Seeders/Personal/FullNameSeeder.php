<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class FullNameSeeder
 *
 * This class generates a full name using the Faker library.
 * It also stores the last generated name in a static variable,
 * allowing other seeders (e.g., FirstNameSeeder) to reuse it.
 */
class FullNameSeeder extends FieldSeeder
{
    /**
     * Stores the last generated full name.
     * This can be accessed statically by other seeders for consistency.
     *
     * @var string|null
     */
    public static ?string $lastGeneratedName = null;

    /**
     * Generate a full name (first and last name).
     *
     * The generated name is stored in the static property for use by other seeders.
     * If `isUnique` is enabled, a unique name will be generated.
     *
     * @return string The generated full name.
     */
    public function generateValue(): string
    {
        self::$lastGeneratedName = $this->isUnique()
            ? self::$faker->unique()->name()
            : self::$faker->name();

        return self::$lastGeneratedName;
    }
}
