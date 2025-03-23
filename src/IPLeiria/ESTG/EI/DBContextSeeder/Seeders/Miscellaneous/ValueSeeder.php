<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class ValueSeeder extends FieldSeeder
{
    private mixed $value;

    public function __construct($tableSeeder, $field, mixed $value)
    {
        parent::__construct($tableSeeder, $field);
        $this->value = $value;
    }

    public function generateValue(): mixed
    {
        return is_callable($this->value) ? ($this->value)() : $this->value;
    }
}
