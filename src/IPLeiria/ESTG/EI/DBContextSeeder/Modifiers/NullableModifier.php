<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

class NullableModifier implements Modifier
{
    private float $percentage;

    public function __construct(float $percentage)
    {
        if ($percentage < 0 || $percentage > 100) {
            throw new \InvalidArgumentException("The percentage must be between 0 and 100.");
        }

        $this->percentage = $percentage;
    }

    public function apply(mixed $value): mixed
    {
        if (mt_rand(0, 100) < $this->percentage) {
            return null;
        }

        return $value;
    }
}
