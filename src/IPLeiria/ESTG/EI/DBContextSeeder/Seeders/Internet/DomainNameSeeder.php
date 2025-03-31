<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Internet;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class DomainNameSeeder extends FieldSeeder
{
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->domainName() : self::$faker->domainWord();
    }
}
