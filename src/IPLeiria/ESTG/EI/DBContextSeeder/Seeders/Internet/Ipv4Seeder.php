<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Internet;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class Ipv4Seeder extends FieldSeeder
{
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->ipv4() : self::$faker->ipv4();
    }
}
