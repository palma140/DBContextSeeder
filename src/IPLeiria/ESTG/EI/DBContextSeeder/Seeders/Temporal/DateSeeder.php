<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Temporal;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class DateSeeder extends FieldSeeder
{
    protected ?string $format;
    protected ?string $startDate;
    protected ?string $endDate;

    public function __construct($tableSeeder, $field, $language, ?string $format = 'Y-m-d', ?string $startDate = '-30 years', ?string $endDate = 'now')
    {
        parent::__construct($tableSeeder, $field, $language);
        $this->format = $format;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function generateValue(): string
    {
        $date = $this->unique
            ? self::$faker->unique()->dateTimeBetween($this->startDate, $this->endDate)
            : self::$faker->dateTimeBetween($this->startDate, $this->endDate);

        return $date->format($this->format);
    }
}
