<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Company;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class CompanySeeder
 *
 * A seeder class for generating company names. It extends the `FieldSeeder` class.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Company
 */
class CompanySeeder extends FieldSeeder
{
    /**
     * Generates a company name.
     *
     * This method generates a unique company name if the `isUnique()` method returns true,
     * or a regular company name if it does not.
     *
     * @return string The generated company name.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->company() : self::$faker->company();
    }
}
