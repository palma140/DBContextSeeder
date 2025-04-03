<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

use IPLeiria\ESTG\EI\DBContextSeeder\Enums\HashAlgorithm;

/**
 * Class HashModifier
 *
 * This class is responsible for applying different hashing algorithms
 * to a given value based on the specified HashAlgorithm.
 */
class HashModifier implements Modifier
{
    /**
     * @var HashAlgorithm The hashing algorithm to use.
     */
    protected HashAlgorithm $algorithm;
    private array $cache = [];

    /**
     * HashModifier constructor.
     *
     * @param HashAlgorithm $algorithm The algorithm to be used for hashing.
     */
    public function __construct(HashAlgorithm $algorithm)
    {
        $this->algorithm = $algorithm;
    }

    /**
     * Applies the selected hashing algorithm to the given value.
     *
     * @param mixed $value The value to be hashed.
     * @return string The hashed value.
     */
    public function apply(mixed $value): string
    {
        if(isset($this->cache[$value])) {
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

        $this->cache[$value] = $hash;

        return $hash;
    }
}
