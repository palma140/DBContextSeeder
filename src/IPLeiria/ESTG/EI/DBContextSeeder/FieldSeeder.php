<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder;

use Faker\Factory as Faker;
use IPLeiria\ESTG\EI\DBContextSeeder\Enums\HashAlgorithm;
use IPLeiria\ESTG\EI\DBContextSeeder\Modifiers\HashModifier;
use IPLeiria\ESTG\EI\DBContextSeeder\Modifiers\Modifier;

abstract class FieldSeeder
{
    protected TableSeeder $tableSeeder;
    protected string $field;
    protected static $faker;
    protected string $language;
    protected bool $unique = false;
    protected array $modifiers = [];

    public function __construct($tableSeeder, $field, $language = 'en_US')
    {
        $this->tableSeeder = $tableSeeder;
        $this->field = $field;

        if (!self::$faker) {
            self::$faker = Faker::create($language);
        }
    }

    public function addModifier(Modifier $modifier): static
    {
        $this->modifiers[] = $modifier;
        return $this;
    }

    public function unique(): static
    {
        $this->unique = true;
        return $this;
    }

    public function hash(HashAlgorithm $algorithm = HashAlgorithm::BCRYPT): static
    {
        return $this->addModifier(new HashModifier($algorithm));
    }


    public function generate(): mixed
    {
        $value = $this->generateValue();

        foreach ($this->modifiers as $modifier) {
            $value = $modifier->apply($value);
        }

        return $value;
    }

    abstract protected function generateValue(): mixed;
}
