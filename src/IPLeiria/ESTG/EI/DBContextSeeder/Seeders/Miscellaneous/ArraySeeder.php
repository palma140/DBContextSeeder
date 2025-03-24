<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class ArraySeeder extends FieldSeeder
{
    protected array $values;

    public function __construct($tableSeeder, $field, array $values = [])
    {
        parent::__construct($tableSeeder, $field, $values);
        $this->values = $values;
    }

    public function generateValue(): mixed
    {
        return $this->unique
            ? self::$faker->unique()->randomElement($this->values)
            : self::$faker->randomElement($this->values);
    }
}
