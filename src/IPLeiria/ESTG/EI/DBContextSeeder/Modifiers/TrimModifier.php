<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

class TrimModifier implements Modifier
{
    private string $characters;


    public function __construct(string $characters)
    {
        $this->characters = $characters;
    }

    public function apply(mixed $value): string
    {
        return trim($value, $this->characters);
    }
}

