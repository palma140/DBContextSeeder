<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

class UniqueModifier implements Modifier
{
    public function apply(mixed $value): mixed
    {
        return $value;
    }
}
