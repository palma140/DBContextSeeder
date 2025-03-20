<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

interface Modifier
{
    public function apply(mixed $value): mixed;
}
