<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Text;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class BothifySeeder extends FieldSeeder
{
    protected string $pattern;

    public function __construct($tableSeeder, $field, string $pattern)
    {
        parent::__construct($tableSeeder, $field);
        $this->pattern = $pattern;
    }

    public function generateValue(): string
    {
        return self::$faker->bothify($this->pattern);
    }
}
