<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Payment;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class CreditCardExpirationDateStringSeeder extends FieldSeeder
{
    protected ?bool $valid = null;

    public function __construct($tableSeeder, $field)
    {
        parent::__construct($tableSeeder, $field);
        $this->valid = !$this->valid;
    }


    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->creditCardExpirationDateString($this->valid) : self::$faker->creditCardExpirationDateString($this->valid);
    }
}
