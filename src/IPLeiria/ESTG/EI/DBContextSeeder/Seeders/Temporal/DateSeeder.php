<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Temporal;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;
use DateTimeZone;
use DateTimeInterface;

/**
 * Class DateSeeder
 *
 * This class generates random dates within a specified range.
 * The generated date can be either unique or non-unique, based on the configuration.
 * A timezone can also be optionally specified.
 */
class DateSeeder extends FieldSeeder
{
    /**
     * The format in which the date will be returned.
     *
     * @var string
     */
    protected string $format;

    /**
     * The start date for the random date range.
     *
     * @var string|DateTimeInterface|null
     */
    protected string|DateTimeInterface|null $startDate;

    /**
     * The end date for the random date range.
     *
     * @var string|DateTimeInterface|null
     */
    protected string|DateTimeInterface|null $endDate;

    /**
     * The timezone used for date generation (stored as string|null).
     *
     * @var string|null
     */
    protected ?string $timezoneName;

    /**
     * DateSeeder constructor.
     *
     * @param TableSeeder $tableSeeder The table seeder instance.
     * @param string $field The field being seeded.
     * @param string|null $format The format for the generated date.
     * @param string|DateTimeInterface|null $startDate The start date for the random range.
     * @param string|DateTimeInterface|null $endDate The end date for the random range.
     * @param DateTimeZone|string|null $timezone Optional timezone to use when generating the date.
     */
    public function __construct(
        TableSeeder $tableSeeder,
        string $field,
        ?string $format = 'Y-m-d',
        string|DateTimeInterface|null $startDate = '-30 years',
        string|DateTimeInterface|null $endDate = 'now',
        DateTimeZone|string|null $timezone = null
    ) {
        parent::__construct($tableSeeder, $field);

        $this->format = $format ?? 'Y-m-d H:i:s';
        $this->startDate = $startDate;
        $this->endDate = $endDate;

        if ($timezone instanceof DateTimeZone) {
            $this->timezoneName = $timezone->getName();
        } elseif (is_string($timezone)) {
            $this->timezoneName = $timezone;
        } else {
            $this->timezoneName = null;
        }
    }

    /**
     * Generate a random date within the specified range and format it.
     *
     * If `isUnique` is enabled, a unique date will be generated. Otherwise,
     * a random date between the start and end dates will be returned.
     * The timezone will be applied if specified.
     *
     * @return string The generated date formatted according to the specified format.
     */
    public function generateValue(): string
    {
        $date = $this->isUnique()
            ? self::$faker->unique()->dateTimeBetween($this->startDate, $this->endDate, $this->timezoneName)
            : self::$faker->dateTimeBetween($this->startDate, $this->endDate, $this->timezoneName);

        return $date->format($this->format);
    }
}
