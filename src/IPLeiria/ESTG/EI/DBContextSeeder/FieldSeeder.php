<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder;

use Faker\Factory as Faker;

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

    public function name(): static
    {
        $this->generator = function () {
            return self::$faker->name();
        };
        return $this;
    }

    public function email(): static
    {
        $this->generator = function () {
            return $this->unique ? self::$faker->unique()->email() : self::$faker->email();
        };
        return $this;
    }

    public function address(): static
    {
        $this->generator = function () {
            return $this->unique ? self::$faker->unique()->address() : self::$faker->address();
        };
        return $this;
    }

    public function phoneNumber(): static
    {
        $this->generator = function () {
            return self::$faker->phoneNumber();
        };
        return $this;
    }

    public function company(): static
    {
        $this->generator = function () {
            return self::$faker->company();
        };
        return $this;
    }

    public function city(): static
    {
        $this->generator = function () {
            return self::$faker->city();
        };
        return $this;
    }

    public function country(): static
    {
        $this->generator = function () {
            return self::$faker->country();
        };
        return $this;
    }

    public function dateOfBirth(): static
    {
        $this->generator = function () {
            return self::$faker->date();
        };
        return $this;
    }

    public function username(): static
    {
        $this->generator = function () {
            return self::$faker->userName();
        };
        return $this;
    }

    public function password(): static
    {
        $this->generator = function () {
            return self::$faker->password();
        };
        return $this;
    }

    public function ipAddress(): static
    {
        $this->generator = function () {
            return self::$faker->ipv4();
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
