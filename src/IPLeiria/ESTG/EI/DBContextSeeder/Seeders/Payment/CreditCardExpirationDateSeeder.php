<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Payment;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

/**
 * Class CreditCardExpirationDateSeeder
 *
 * This class generates random credit card expiration dates.
 * The generated expiration date can be either valid or invalid, based on the configuration.
 */
class CreditCardExpirationDateSeeder extends FieldSeeder
{
    /**
     * Whether the generated credit card expiration date should be valid or not.
     *
     * @var bool|null
     */
    protected ?bool $valid = null;

    /**
     * CreditCardExpirationDateSeeder constructor.
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
     * Generate random credit card expiration date.
     *
     * If `isUnique` is enabled, a unique expiration date will be generated. Otherwise,
     * a random expiration date is returned.
     *
     * @return \DateTime The generated credit card expiration date.
     */
    public function generateValue(): \DateTime
    {
        return $this->isUnique() ? self::$faker->unique()->creditCardExpirationDate($this->valid) : self::$faker->creditCardExpirationDate($this->valid);
    }
}
