<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Text;

use Illuminate\Support\Str;
use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

/**
 * Class RandomStringSeeder
 *
 * This class generates random strings of a given size. It ensures uniqueness if needed.
 */
class RandomStringSeeder extends FieldSeeder
{
    /**
     * The size of the generated random string.
     *
     * @var int
     */
    protected int $string_size;

    /**
     * An array to store already generated values to ensure uniqueness.
     *
     * @var array
     */
    private array $used_values = [];

    /**
     * RandomStringSeeder constructor.
     *
     * @param TableSeeder $tableSeeder The table seeder instance.
     * @param string $fieldSeeder The field being seeded.
     * @param int|null $string_size The size of the random string to generate.
     */
    public function __construct(TableSeeder $tableSeeder, string $fieldSeeder, int $string_size = null)
    {
        parent::__construct($tableSeeder, $fieldSeeder);
        $this->string_size = $string_size;
    }

    /**
     * Generate a random string of the specified size.
     *
     * If uniqueness is required, it will keep generating a new string until it is unique.
     *
     * @return string The generated random string.
     */
    public function generateValue(): string
    {
        do {
            $random_string = Str::random($this->string_size);
        } while ($this->isUnique() && isset($this->used_values[$random_string]));

        if ($this->isUnique()) {
            $this->used_values[$random_string] = true;
        }

        return $random_string;
    }
}
