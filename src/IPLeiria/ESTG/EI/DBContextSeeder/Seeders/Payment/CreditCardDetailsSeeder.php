<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Payment;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

/**
 * Class CreditCardDetailsSeeder
 *
 * This class generates random credit card details.
 * The generated credit card details can be either valid or invalid, based on the configuration.
 */
class CreditCardDetailsSeeder extends FieldSeeder
{
    /**
     * Whether the generated credit card details should be valid or not.
     *
     * @var bool|null
     */
    protected ?bool $valid = null;

    /**
     * CreditCardDetailsSeeder constructor.
     *
     * @param TableSeeder $tableSeeder The table seeder instance.
     * @param String $field The field being seeded.
     */
    public function __construct(TableSeeder $tableSeeder, string $field)
    {
        parent::__construct($tableSeeder, $field);
        $this->valid = !$this->valid;
    }

    /**
     * Generate random credit card details.
     *
     * If `isUnique` is enabled, unique credit card details will be generated. Otherwise,
     * random credit card details are returned.
     *
     * @return array The generated credit card details.
     */
    public function generateValue(): array
    {
        return $this->isUnique() ? self::$faker->unique()->creditCardDetails($this->valid) : self::$faker->creditCardDetails($this->valid);
    }
}
