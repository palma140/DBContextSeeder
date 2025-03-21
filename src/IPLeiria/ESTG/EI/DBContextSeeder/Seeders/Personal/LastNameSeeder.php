<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class LastNameSeeder extends FieldSeeder
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
            $nameParts = explode(' ', FullNameSeeder::$lastGeneratedName);
            return end($nameParts); // Último nome
        }

        return $this->unique ? self::$faker->unique()->lastName() : self::$faker->lastName();
    }
}
