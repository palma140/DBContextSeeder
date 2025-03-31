<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class EmojiSeeder extends FieldSeeder
{
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->emoji() : self::$faker->emoji();
    }
}
