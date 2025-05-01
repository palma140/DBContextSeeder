<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Text;

use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

/**
 * Class LetterSeeder
 *
 * This class generates a random letter. If uniqueness is required, it ensures that
 * the generated letter is unique across the seeder.
 */
class LetterSeeder extends FieldSeeder
{
    /**
     * Generate a random letter.
     *
     * If uniqueness is enabled, this method ensures that the generated letter is unique.
     * If uniqueness is not required, it simply generates a random letter.
     *
     * @return string The generated random letter.
     */
    public function generateValue(): string
    {
        return $this->isUnique() ? self::$faker->unique()->randomLetter() : self::$faker->randomLetter();
    }
}
