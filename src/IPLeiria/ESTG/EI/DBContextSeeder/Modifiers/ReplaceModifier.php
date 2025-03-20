<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

class ReplaceModifier implements Modifier
{
    protected string $search;
    protected string $replace;

    public function __construct(string $search, string $replace)
    {
        $this->search = $search;
        $this->replace = $replace;
    }

    public function apply(mixed $value): mixed
    {
        return str_replace($this->search, $this->replace, $value);
    }
}
