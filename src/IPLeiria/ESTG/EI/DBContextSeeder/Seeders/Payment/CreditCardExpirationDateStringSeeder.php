<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Payment;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class CreditCardExpirationDateStringSeeder
 *
 * Generates a credit card expiration date as a string.
 * The value can be either valid or invalid depending on the internal flag.
 */
class CreditCardExpirationDateStringSeeder extends FieldSeeder
{
    /**
     * Determines whether the generated expiration date should be valid.
     *
     * @var bool|null
     */
    protected ?bool $valid = null;

    /**
     * Constructor for CreditCardExpirationDateStringSeeder.
     *
     * @param mixed $tableSeeder The parent table seeder.
     * @param string $field The field this seeder is targeting.
     */
    public function __construct($tableSeeder, string $field)
    {
        parent::__construct($tableSeeder, $field);
        $this->valid = !$this->valid;
    }

    /**
     * Generate a string representing a credit card expiration date.
     *
     * If uniqueness is required, it returns a unique expiration string.
     * The string may or may not represent a valid date depending on `$valid`.
     *
     * @return string The generated expiration date as string.
     */
    public function generateValue(): string
    {
        return $this->isUnique()
            ? self::$faker->unique()->creditCardExpirationDateString($this->valid)
            : self::$faker->creditCardExpirationDateString($this->valid);
    }
}
