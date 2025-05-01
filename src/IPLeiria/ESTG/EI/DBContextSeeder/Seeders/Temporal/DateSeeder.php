<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Temporal;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

/**
 * Class DateSeeder
 *
 * This class generates random dates within a specified range.
 * The generated date can be either unique or non-unique, based on the configuration.
 */
class DateSeeder extends FieldSeeder
{
    /**
     * The format in which the date will be returned.
     *
     * @var string|null
     */
    protected ?string $format;

    /**
     * The start date for the random date range.
     *
     * @var string|null
     */
    protected ?string $startDate;

    /**
     * The end date for the random date range.
     *
     * @var string|null
     */
    protected ?string $endDate;

    /**
     * DateSeeder constructor.
     *
     * @param TableSeeder $tableSeeder The table seeder instance.
     * @param String $field The field being seeded.
     * @param String|null $format The format for the generated date.
     * @param String|null $startDate The start date for the random range.
     * @param String|null $endDate The end date for the random range.
     */
    public function __construct(TableSeeder $tableSeeder, string $field, ?string $format = 'Y-m-d', ?string $startDate = '-30 years', ?string $endDate = 'now')
    {
        parent::__construct($tableSeeder, $field);
        $this->format = $format ?? 'Y-m-d H:i:s';
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * Generate a random date within the specified range and format it.
     *
     * If `isUnique` is enabled, a unique date will be generated. Otherwise,
     * a random date between the start and end dates will be returned.
     *
     * @return string The generated date formatted according to the specified format.
     */
    public function generateValue(): string
    {
        $date = $this->isUnique()
            ? self::$faker->unique()->dateTimeBetween($this->startDate, $this->endDate)
            : self::$faker->dateTimeBetween($this->startDate, $this->endDate);

        return $date->format($this->format);
    }
}
