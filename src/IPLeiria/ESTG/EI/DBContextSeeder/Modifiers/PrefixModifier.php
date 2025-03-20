<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

class PrefixModifier implements Modifier
{
    protected string $prefix;

    public function __construct(string $prefix)
    {
        $this->prefix = $prefix;
    }

    public function apply(mixed $value): mixed
    {
        return $this->prefix . $value;
    }
}
