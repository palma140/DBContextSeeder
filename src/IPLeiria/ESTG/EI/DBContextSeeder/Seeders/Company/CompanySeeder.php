<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Company;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class CompanySeeder extends FieldSeeder
{
    public function generateValue(): string
    {
        return $this->unique ? self::$faker->unique()->company() : self::$faker->company();
    }
}
