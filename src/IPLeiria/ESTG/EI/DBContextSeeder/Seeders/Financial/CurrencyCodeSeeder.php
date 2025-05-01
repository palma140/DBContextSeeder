<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Financial;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class CurrencyCodeSeeder
 *
 * A seeder class for generating currency codes. It extends the `FieldSeeder` class.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Financial
 */
class CurrencyCodeSeeder extends FieldSeeder
{
    /**
     * Generates a currency code.
     *
     * This method generates a unique currency code if the `isUnique()` method returns true,
     * or a regular currency code if it does not.
     *
     * @return string The generated currency code.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->currencyCode() : self::$faker->currencyCode();
    }
}
