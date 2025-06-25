<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder;

use Faker\Factory as Faker;
use IPLeiria\ESTG\EI\DBContextSeeder\Enums\HashAlgorithm;
use IPLeiria\ESTG\EI\DBContextSeeder\Modifiers\CallbackModifier;
use IPLeiria\ESTG\EI\DBContextSeeder\Modifiers\GenerateFromFieldModifier;
use IPLeiria\ESTG\EI\DBContextSeeder\Modifiers\HashModifier;
use IPLeiria\ESTG\EI\DBContextSeeder\Modifiers\LookupModifier;
use IPLeiria\ESTG\EI\DBContextSeeder\Modifiers\LowercaseModifier;
use IPLeiria\ESTG\EI\DBContextSeeder\Modifiers\Modifier;
use IPLeiria\ESTG\EI\DBContextSeeder\Modifiers\NullableModifier;
use IPLeiria\ESTG\EI\DBContextSeeder\Modifiers\RemoveAccentsModifier;
use IPLeiria\ESTG\EI\DBContextSeeder\Modifiers\RowAwareModifier;
use IPLeiria\ESTG\EI\DBContextSeeder\Modifiers\UniqueModifier;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous\FileSeeder;

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
     */
    public function __construct(TableSeeder $tableSeeder, string $field)
    {
        $this->tableSeeder = $tableSeeder;
        $this->field = $field;

        if (!self::$faker) {
            $this->language = $this->tableSeeder->getLanguage();
            self::$faker = Faker::create($this->language);
        }
    }

    /**
     * Adds a modifier to the field.
     *
     * @param Modifier|RowAwareModifier $modifier The modifier to apply.
     * @return static Returns the current instance for method chaining.
     */
    public function addModifier(Modifier|RowAwareModifier $modifier): static
    {
        $this->modifiers[] = $modifier;
        return $this;
    }

    /**
     * Checks if the field has a uniqueness constraint.
     *
     * @return bool True if the field should be unique, false otherwise.
     */
    public function isUnique(): bool
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
     * Removes accents from the field value.
     *
     * @param string $ignoreCharacters Characters to ignore when removing accents.
     * @return static Returns the current instance for method chaining.
     */
    public function removeAccents(string $ignoreCharacters = ''): static
    {
        return $this->addModifier(new RemoveAccentsModifier($ignoreCharacters));
    }

    /**
     * Applies a callback modifier to the field value.
     *
     * @param callable $callback The callback function to apply.
     * @return static Returns the current instance for method chaining.
     */
    public function callback(callable $callback): static
    {
        return $this->addModifier(new CallbackModifier($callback));
    }

    /**
     * Converts the field value to lowercase.
     *
     * @return static Returns the current instance for method chaining.
     */
    public function lowercase(): static
    {
        return $this->addModifier(new LowercaseModifier());
    }

    /**
     * Generates a value for the field based on another field.
     *
     * @param string $sourceField The source field name.
     * @param callable $callback The callback to generate the value.
     * @return static Returns the current instance for method chaining.
     */
    public function generateFromField(string $sourceField, callable $callback): static
    {
        return $this->addModifier(new GenerateFromFieldModifier($sourceField, $callback));
    }

    public function lookup(string $table, callable $matcher, callable $callback): static
    {
        return $this->addModifier(new LookupModifier($table, $matcher, $callback));
    }

    /**
     * Generates a value for the field, applying all modifiers.
     *
     * @return mixed The generated field value.
     */
    public function generate(array $row = []): mixed
    {
        try {
            if($this instanceof FileSeeder) {
                $value = $this->generateValueWithRow($row);
            } else {
                $value = $this->generateValue();
            }
        } catch (\OverflowException $e) {
            $column = $this->field;
            echo "\n\e[31m❌ OverflowException: Maximum retries reached for column '{$column}'\e[0m\n";

            throw $e;
        }

        foreach ($this->modifiers as $modifier) {
            $value = $modifier->apply($value, $row);
        }

        return $value;
    }

    abstract protected function generateValue(): mixed;
}
