<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Text;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class LetterSeeder extends FieldSeeder
{
    public function generateValue(): string
    {
        return $this->unique ? self::$faker->unique()->randomLetter() : self::$faker->randomLetter();
    }
}
