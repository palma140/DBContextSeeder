<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Temporal;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class TimezoneSeeder extends FieldSeeder
{
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->timezone() : self::$faker->timezone();
    }
}
