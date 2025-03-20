<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

class LowercaseModifier implements Modifier
{
    public function apply(mixed $value): string
    {
        return strtolower($value);
    }
}
