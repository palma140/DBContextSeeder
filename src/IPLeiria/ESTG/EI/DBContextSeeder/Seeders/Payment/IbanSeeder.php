<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Payment;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class IbanSeeder
 *
 * Generates a fake IBAN (International Bank Account Number) based on the specified parameters.
 * The generated IBAN can be unique or not, depending on configuration.
 */
class IbanSeeder extends FieldSeeder
{
    /**
     * The country code (e.g., "PT") used for the IBAN.
     *
     * @var string|null
     */
    protected ?string $countryCode = null;

    /**
     * The bank prefix to include in the IBAN.
     *
     * @var string|null
     */
    protected ?string $prefix = null;

    /**
     * The total length of the IBAN.
     *
     * @var int|null
     */
    protected ?int $length = null;

    /**
     * IbanSeeder constructor.
     *
     * @param mixed $tableSeeder The table seeder instance.
     * @param string $field The field to be seeded.
     * @param string|null $countryCode The country code for the IBAN.
     * @param string|null $prefix The prefix to be used in the IBAN.
     * @param int|null $length The total desired length of the IBAN.
     */
    public function __construct($tableSeeder, string $field, ?string $countryCode, ?string $prefix, ?int $length)
    {
        parent::__construct($tableSeeder, $field);
        $this->countryCode = $countryCode;
        $this->prefix = $prefix;
        $this->length = $length;
    }

    /**
     * Generate a fake IBAN.
     *
     * If uniqueness is enabled, ensures the IBAN hasn't been generated before.
     *
     * @return string The generated IBAN.
     */
    public function generateValue(): string
    {
        return $this->isUnique()
            ? self::$faker->unique()->iban($this->countryCode, $this->prefix, $this->length)
            : self::$faker->iban($this->countryCode, $this->prefix, $this->length);
    }
}
