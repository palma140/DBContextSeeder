<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Internet;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class UrlSeeder extends FieldSeeder
{
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->url() : self::$faker->url();
    }
}
