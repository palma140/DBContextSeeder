<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Internet;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class Ipv6Seeder extends FieldSeeder
{
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->ipv6() : self::$faker->ipv6();
    }
}
