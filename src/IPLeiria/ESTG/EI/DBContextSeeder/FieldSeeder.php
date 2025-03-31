<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder;

use Faker\Factory as Faker;
use Illuminate\Validation\Rules\Unique;
use IPLeiria\ESTG\EI\DBContextSeeder\Enums\HashAlgorithm;
use IPLeiria\ESTG\EI\DBContextSeeder\Modifiers\HashModifier;
use IPLeiria\ESTG\EI\DBContextSeeder\Modifiers\Modifier;
use IPLeiria\ESTG\EI\DBContextSeeder\Modifiers\NullableModifier;
use IPLeiria\ESTG\EI\DBContextSeeder\Modifiers\UniqueModifier;

abstract class FieldSeeder
{
    protected TableSeeder $tableSeeder;
    protected string $field;
    protected static $faker;
    protected string $language;
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

    protected function isUnique(): bool
    {
        foreach ($this->modifiers as $modifier) {
            if ($modifier instanceof UniqueModifier) {
                return true;
            }
        }
        return false;
    }

    public function unique(): static
    {
        return $this->addModifier(new UniqueModifier());
    }

    public function hash(HashAlgorithm $algorithm = HashAlgorithm::BCRYPT): static
    {
        return $this->addModifier(new HashModifier($algorithm));
    }

    public function nullable(float $percentage) : static
    {
        return $this->addModifier(new NullableModifier($percentage));
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
