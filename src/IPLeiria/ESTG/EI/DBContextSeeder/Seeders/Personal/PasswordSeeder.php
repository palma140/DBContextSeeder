<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use InvalidArgumentException;

class PasswordSeeder extends FieldSeeder
{
    protected int $minLength;
    protected int $maxLength;

    public function __construct($tableSeeder, $field, $language, int $minLength = 8, int $maxLength = 16)
    {
        parent::__construct($tableSeeder, $field, $language);

        if ($minLength < 1 || $maxLength < $minLength) {
            throw new InvalidArgumentException("Invalid password length range: min=$minLength, max=$maxLength");
        }

        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
    }

    public function generateValue(): string
    {
        return self::$faker->password($this->minLength, $this->maxLength);
    }
}
