<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * SequentionalNumberSeeder generates sequential numbers as string values.
 */
class SequentionalNumberSeeder extends FieldSeeder
{
    /** @var int The starting number of the sequence. */
    protected int $start;

    /** @var int The current number in the sequence. */
    private int $currentNumber;

    /**
     * Constructor.
     *
     * @param mixed $tableSeeder The parent table seeder.
     * @param string $field The field name.
     * @param int $start The starting value of the sequence (default is 0).
     */
    public function __construct($tableSeeder, $field, $start = 0)
    {
        parent::__construct($tableSeeder, $field);
        $this->start = $start;
        $this->currentNumber = $start;
    }

    /**
     * Generates the next value in the sequence.
     *
     * @return string The current number in the sequence as a string.
     */
    public function generateValue(): string
    {
        $value = $this->currentNumber;
        $this->currentNumber++;
        return (string) $value;
    }

    /**
     * Gets the current number in the sequence.
     *
     * @return int The current number.
     */
    public function getCurrentNumber(): int
    {
        return $this->currentNumber;
    }

    /**
     * Sets the current number in the sequence.
     *
     * @param int $number The new current number.
     */
    public function setCurrentNumber(int $number): void
    {
        $this->currentNumber = $number;
    }
}
