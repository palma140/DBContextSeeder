<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

/**
 * Class BooleanSeeder
 *
 * A seeder class that generates boolean values (true/false), optionally using a chance percentage
 * to determine the likelihood of returning `true`.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous
 */
class BooleanSeeder extends FieldSeeder
{
    /**
     * @var int|null Chance (0-100) of getting true when generating a boolean.
     */
    protected ?int $chanceOfGettingTrue = null;

    /**
     * BooleanSeeder constructor.
     *
     * @param TableSeeder $tableSeeder The table seeder instance.
     * @param string $field The field being seeded.
     * @param int|null $chanceOfGettingTrue Chance (0–100) of returning true. Null for default behavior.
     */
    public function __construct(TableSeeder $tableSeeder, string $field, ?int $chanceOfGettingTrue)
    {
        parent::__construct($tableSeeder, $field);
        $this->chanceOfGettingTrue = $chanceOfGettingTrue;
    }

    /**
     * Generates a boolean value based on the given chance of getting true.
     *
     * Uses the Faker library to optionally ensure uniqueness and control the probability.
     *
     * @return string "1" for true, "0" for false (as string).
     */
    public function generateValue(): string
    {
        return $this->isUnique()
            ? self::$faker->unique()->boolean($this->chanceOfGettingTrue)
            : self::$faker->boolean($this->chanceOfGettingTrue);
    }
}
