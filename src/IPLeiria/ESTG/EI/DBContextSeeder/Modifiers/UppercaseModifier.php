<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

class UppercaseModifier implements Modifier
{
    public function apply(mixed $value): string
    {
        return strtoupper($value);
    }
}
