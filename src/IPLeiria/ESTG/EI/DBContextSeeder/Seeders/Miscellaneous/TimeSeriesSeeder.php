<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use Closure;
use DateInterval;
use DateTime;
use Exception;
use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

class TimeSeriesSeeder extends FieldSeeder
{
    protected array $allDates = [];
    protected int $index = 0;

    /**
     * @param TableSeeder $tableSeeder
     * @param string $field
     * @param string $startDate
     * @param string $endDate
     * @param string $granularity
     * @param Closure|null $entriesPerPeriod function(DateTime): int
     * @param Closure|null $entryFactory function(DateTime): array
     * @param Closure|null $deltaAvg function(DateTime): int (positivo ou negativo)
     */
    public function __construct(
        TableSeeder $tableSeeder,
        string $field,
        string $startDate,
        string $endDate,
        string $granularity = 'daily',
        ?Closure $entriesPerPeriod = null,
        ?Closure $entryFactory = null,
        ?Closure $deltaAvg = null
    ) {
        parent::__construct($tableSeeder, $field);

        $entriesPerPeriod = $entriesPerPeriod ?? fn(DateTime $date) => rand(1, 3);
        $entryFactory = $entryFactory ?? fn(DateTime $date) => ['date' => $date->format('Y-m-d')];

        $currentDate = new DateTime($startDate);
        $end = new DateTime($endDate);

        while ($currentDate <= $end) {
            $baseCount = $entriesPerPeriod($currentDate);

            if ($deltaAvg !== null) {
                $delta = $deltaAvg($currentDate, $baseCount);
                $count = max(0, $baseCount + $delta);
            } else {
                $count = $baseCount;
            }

            for ($i = 0; $i < $count; $i++) {
                $this->allDates[] = $entryFactory(clone $currentDate);
            }
            $this->advanceDate($currentDate, $granularity);
        }
    }

    public function generateValue(): mixed
    {
        $entry = $this->allDates[$this->index++];

        return $entry['date'];
    }

    protected function advanceDate(DateTime &$date, string $granularity): void
    {
        $interval = match ($granularity) {
            'daily' => new DateInterval('P1D'),
            'weekly' => new DateInterval('P1W'),
            'monthly' => new DateInterval('P1M'),
            default => throw new Exception("Invalid granularity: {$granularity}"),
        };

        $date->add($interval);
    }
}
