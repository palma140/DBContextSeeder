<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Payment;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class CreditCardExpirationDateSeeder extends FieldSeeder
{
    protected ?bool $valid = null;

    public function __construct($tableSeeder, $field)
    {
        parent::__construct($tableSeeder, $field);
        $this->valid = !$this->valid;
    }


    public function generateValue(): \DateTime
    {
        return $this->unique ? self::$faker->unique()->creditCardExpirationDate($this->valid) : self::$faker->creditCardExpirationDate($this->valid);
    }
}
