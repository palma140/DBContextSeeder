<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Internet;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class UrlSeeder
 *
 * A seeder class for generating URLs. It extends the `FieldSeeder` class.
 * This class generates either a unique or a regular URL for use in seeding data.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Internet
 */
class UrlSeeder extends FieldSeeder
{
    /**
     * Generates a URL.
     *
     * This method generates a unique URL if the `isUnique()` method returns true,
     * or a regular URL if it does not.
     *
     * @return string The generated URL.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->url() : self::$faker->url();
    }
}
