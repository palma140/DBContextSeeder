<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

/**
 * Class ValueSeeder
 *
 * This class allows seeding a field with a fixed value or a dynamically generated value.
 * If the value provided is callable, it will be executed to generate the value, otherwise,
 * the fixed value will be used.
 */
class ValueSeeder extends FieldSeeder
{
    /**
     * @var mixed The value to be used for seeding the field. It can either be a fixed value or a callable.
     */
    private mixed $value;

    /**
     * ValueSeeder constructor.
     *
     * @param TableSeeder $tableSeeder The table seeder that invokes this seeder.
     * @param string $field The field to be populated with the value.
     * @param mixed $value The value or callable to be used for seeding the field.
     */
    public function __construct(TableSeeder $tableSeeder, string $field, mixed $value)
    {
        parent::__construct($tableSeeder, $field);
        $this->value = $value;
    }

    /**
     * Generate a value for the field.
     * If the value is callable, it will be executed to generate the value.
     * Otherwise, the fixed value will be used.
     *
     * @return mixed The generated value.
     */
    public function generateValue(): mixed
    {
        return is_callable($this->value) ? ($this->value)() : $this->value;
    }
}
