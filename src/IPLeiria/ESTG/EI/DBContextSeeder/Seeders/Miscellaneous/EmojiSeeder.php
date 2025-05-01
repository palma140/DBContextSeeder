<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * EmojiSeeder generates random emoji values using Faker.
 */
class EmojiSeeder extends FieldSeeder
{
    /**
     * Generates a random emoji.
     *
     * If the field is set to be unique, it ensures the emoji is unique within the generated dataset.
     *
     * @return string A randomly selected emoji.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->emoji() : self::$faker->emoji();
    }
}
