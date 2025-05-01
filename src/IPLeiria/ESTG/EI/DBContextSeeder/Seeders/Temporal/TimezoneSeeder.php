<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Temporal;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class TimezoneSeeder
 *
 * This class generates a random timezone.
 * The generated timezone can be either unique or non-unique, based on the configuration.
 */
class TimezoneSeeder extends FieldSeeder
{
    /**
     * Generate a random timezone.
     *
     * If `isUnique` is enabled, a unique timezone will be generated. Otherwise,
     * a random timezone will be returned.
     *
     * @return string The generated timezone.
     */
    public function generateValue(): string
    {
        // Generate a unique or non-unique timezone
        return $this->isUnique() ? self::$faker->unique()->timezone() : self::$faker->timezone();
    }
}
