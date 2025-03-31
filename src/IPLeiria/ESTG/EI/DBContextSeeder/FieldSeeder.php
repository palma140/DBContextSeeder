<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder;

use Faker\Factory as Faker;
use IPLeiria\ESTG\EI\DBContextSeeder\Enums\HashAlgorithm;
use IPLeiria\ESTG\EI\DBContextSeeder\Modifiers\HashModifier;
use IPLeiria\ESTG\EI\DBContextSeeder\Modifiers\Modifier;
use IPLeiria\ESTG\EI\DBContextSeeder\Modifiers\NullableModifier;
use IPLeiria\ESTG\EI\DBContextSeeder\Modifiers\UniqueModifier;

/**
 * Class FieldSeeder
 *
 * Abstract class responsible for generating field values for database seeding.
 * Supports various modifiers such as uniqueness, hashing, and nullability.
 */
abstract class FieldSeeder
{
    /** @var TableSeeder The associated table seeder instance */
    protected TableSeeder $tableSeeder;

    /** @var string The name of the field being seeded */
    protected string $field;

    /** @var static The Faker instance for generating random data */
    protected static $faker;

    /** @var string The language locale for Faker */
    protected string $language;

    /** @var Modifier[] List of modifiers applied to the field */
    protected array $modifiers = [];

    /**
     * FieldSeeder constructor.
     *
     * @param TableSeeder $tableSeeder The table seeder instance.
     * @param string $field The field name.
     * @param string $language The locale for Faker (default: 'en_US').
     */
    public function __construct(TableSeeder $tableSeeder, string $field, string $language = 'en_US')
    {
        $this->tableSeeder = $tableSeeder;
        $this->field = $field;

        if (!self::$faker) {
            self::$faker = Faker::create($language);
        }
    }

    /**
     * Adds a modifier to the field.
     *
     * @param Modifier $modifier The modifier to apply.
     * @return static Returns the current instance for method chaining.
     */
    public function addModifier(Modifier $modifier): static
    {
        $this->modifiers[] = $modifier;
        return $this;
    }

    /**
     * Checks if the field has a uniqueness constraint.
     *
     * @return bool True if the field should be unique, false otherwise.
     */
    protected function isUnique(): bool
    {
        foreach ($this->modifiers as $modifier) {
            if ($modifier instanceof UniqueModifier) {
                return true;
            }
        }
        return false;
    }

    /**
     * Marks the field as unique.
     *
     * @return static Returns the current instance for method chaining.
     */
    public function unique(): static
    {
        return $this->addModifier(new UniqueModifier());
    }

    /**
     * Applies a hashing modifier to the field.
     *
     * @param HashAlgorithm $algorithm The hashing algorithm to use (default: BCRYPT).
     * @return static Returns the current instance for method chaining.
     */
    public function hash(HashAlgorithm $algorithm = HashAlgorithm::BCRYPT): static
    {
        return $this->addModifier(new HashModifier($algorithm));
    }

    /**
     * Marks the field as nullable with a given probability.
     *
     * @param float $percentage The probability (0 to 1) that the field will be null.
     * @return static Returns the current instance for method chaining.
     */
    public function nullable(float $percentage): static
    {
        return $this->addModifier(new NullableModifier($percentage));
    }

    /**
     * Generates a value for the field, applying all modifiers.
     *
     * @return mixed The generated field value.
     */
    public function generate(): mixed
    {
        $value = $this->generateValue();

        foreach ($this->modifiers as $modifier) {
            $value = $modifier->apply($value);
        }

        return $value;
    }

    /**
     * Abstract method that must be implemented to generate the raw field value.
     *
     * @return mixed The generated raw value.
     */
    abstract protected function generateValue(): mixed;
}
