<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class FirstNameSeeder extends FieldSeeder
{
    protected ?string $gender = null;

    public function __construct($tableSeeder, $field, $language, ?string $gender = null)
    {
        parent::__construct($tableSeeder, $field, $language);
        $this->gender = $gender;
    }
    public function generateValue(): string
    {
        if (FullNameSeeder::$lastGeneratedName) {
            $nameParts = explode(' ', FullNameSeeder::$lastGeneratedName, 2);
            return $nameParts[0]; // Primeiro nome
        }

        return $this->unique ? self::$faker->unique()->firstName($this->gender) : self::$faker->firstName($this->gender);
    }
}
