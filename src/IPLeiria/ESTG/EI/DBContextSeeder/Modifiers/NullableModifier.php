<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

/**
 * Class NullableModifier
 *
 * A modifier that randomly replaces a value with null based on a given probability.
 */
class NullableModifier implements Modifier
{
    /** @var float The probability percentage (0 to 100) of setting a value to null. */
    private float $percentage;

    /**
     * NullableModifier constructor.
     *
     * @param float $percentage The probability (0-100) that a value will be set to null.
     * @throws \InvalidArgumentException If the percentage is out of the valid range.
     */
    public function __construct(float $percentage)
    {
        if ($percentage < 0 || $percentage > 100) {
            throw new \InvalidArgumentException("The percentage must be between 0 and 100.");
        }

        $this->percentage = $percentage;
    }

    /**
     * Applies the nullable modification to the given value.
     *
     * @param mixed $value The input value.
     * @return mixed|null The original value or null, based on the probability.
     */
    public function apply(mixed $value): mixed
    {
        if (mt_rand(0, 100) < $this->percentage) {
            return null;
        }

        return $value;
    }
}
