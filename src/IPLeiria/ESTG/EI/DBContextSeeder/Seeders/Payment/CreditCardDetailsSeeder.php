<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Payment;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class CreditCardDetailsSeeder extends FieldSeeder
{
    protected ?bool $valid = null;

    public function __construct($tableSeeder, $field)
    {
        parent::__construct($tableSeeder, $field);
        $this->valid = !$this->valid;
    }


    public function generateValue(): array
    {
        return $this->isUnique() ? self::$faker->unique()->creditCardDetails($this->valid) : self::$faker->creditCardDetails($this->valid);
    }
}
