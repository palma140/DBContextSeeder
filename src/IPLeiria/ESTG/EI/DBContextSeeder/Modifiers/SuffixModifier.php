<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

class SuffixModifier implements Modifier
{
    protected string $suffix;

    public function __construct(string $suffix)
    {
        $this->suffix = $suffix;
    }

    public function apply(mixed $value): mixed
    {
        return $value . $this->suffix;
    }
}
