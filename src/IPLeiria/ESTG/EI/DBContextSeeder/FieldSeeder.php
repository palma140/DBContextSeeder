<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder;

use faker\Factory as Faker;
class FieldSeeder
{
    protected $tableSeeder;
    protected $field;
    protected $generator;
    protected $unique = false;
    protected $language;

    private static $faker;

    public function __construct($tableSeeder, $field, $language) {
        $this->tableSeeder = $tableSeeder;
        $this->field = $field;
        $this->language = $language;
        if (!self::$faker) {
            self::$faker = Faker::create($language);
        }
    }

    public function randomName(): static
    {
        $this->generator = function () {
            return self::$faker->name();
        };
        return $this;
    }

    public function randomEmail(): static
    {
        $this->generator = function () {
            if ($this->unique) {
                return self::$faker->unique()->email();
            }
            return self::$faker->email();
        };
        return $this;
    }

    public function randomAddress() : static
    {
        $this->generator = function () {
            if ($this->unique) {
                return self::$faker->unique()->address();
            }
            return self::$faker->address();
        };

        return $this;
    }

    public function value($value): static
    {
        $this->generator = function () use ($value) {
            return $value;
        };
        return $this;
    }

    public function unique(): static
    {
        $this->unique = true;
        return $this;
    }

    public function generate() {
        return call_user_func($this->generator);
    }
}
