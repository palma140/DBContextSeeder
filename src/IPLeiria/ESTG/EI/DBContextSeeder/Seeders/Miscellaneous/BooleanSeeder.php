<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class BooleanSeeder extends FieldSeeder
{
    protected ?int $chanceOfGettingTrue = null;

    public function __construct($tableSeeder, $field, $chanceOfGettingTrue)
    {
        parent::__construct($tableSeeder, $field);
        $this->chanceOfGettingTrue = $chanceOfGettingTrue;
    }


    public function generateValue(): string
    {
        return $this->unique ? self::$faker->unique()->boolean($this->chanceOfGettingTrue) : self::$faker->boolean($this->chanceOfGettingTrue);
    }
}
