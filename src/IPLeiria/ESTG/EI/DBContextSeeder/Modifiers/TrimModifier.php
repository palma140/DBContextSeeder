<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

class TrimModifier implements Modifier
{
    public function apply(mixed $value): string
    {
        return trim($value);
    }
}

