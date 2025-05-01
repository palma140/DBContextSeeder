<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

use IPLeiria\ESTG\EI\DBContextSeeder\Enums\HashAlgorithm;

/**
 * Class HashModifier
 *
 * Applies a specified hashing algorithm to a given value.
 * Caches previously computed hashes to improve performance on repeated values.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Modifiers
 */
class HashModifier implements Modifier
{
    /**
     * The hashing algorithm to use.
     *
     * @var HashAlgorithm
     */
    protected HashAlgorithm $algorithm;

    /**
     * Cache for storing previously hashed values.
     * This avoids redundant hashing operations for the same input.
     *
     * @var array<string, string>
     */
    private array $cache = [];

    /**
     * HashModifier constructor.
     *
     * @param HashAlgorithm $algorithm The hashing algorithm to apply.
     */
    public function __construct(HashAlgorithm $algorithm)
    {
        $this->algorithm = $algorithm;
    }

    /**
     * Applies the hashing algorithm to the provided value.
     *
     * If the value was previously hashed, the result is retrieved from cache.
     *
     * @param mixed $value The value to hash.
     * @return string The hashed result.
     */
    public function apply(mixed $value): string
    {
        if (isset($this->cache[$value])) {
            return $this->cache[$value];
        }

        $hash = match ($this->algorithm) {
            HashAlgorithm::BCRYPT => password_hash($value, PASSWORD_BCRYPT),
            HashAlgorithm::ARGON2I => password_hash($value, PASSWORD_ARGON2I),
            HashAlgorithm::ARGON2ID => password_hash($value, PASSWORD_ARGON2ID),
            HashAlgorithm::MD5 => md5($value),
            HashAlgorithm::SHA1 => sha1($value),
            HashAlgorithm::SHA256 => hash('sha256', $value),
        };

        return $this->cache[$value] = $hash;
    }
}
