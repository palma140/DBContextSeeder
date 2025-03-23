<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Payment;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class IbanSeeder extends FieldSeeder
{
    protected ?string $countryCode = null;
    protected ?string $prefix = null;
    protected ?int $length = null;


    public function __construct($tableSeeder, $field, $countryCode, $prefix, $length)
    {
        parent::__construct($tableSeeder, $field);
        $this->prefix = $prefix;
        $this->countryCode = $countryCode;
        $this->length = $length;
    }


    public function generateValue(): string
    {
        return $this->unique ? self::$faker->unique()->iban($this->countryCode, $this->prefix, $this->length) : self::$faker->iban($this->countryCode, $this->prefix, $this->length);
    }
}
