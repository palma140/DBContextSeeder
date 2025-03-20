<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Modifiers;

use IPLeiria\ESTG\EI\DBContextSeeder\Enums\HashAlgorithm;

class HashModifier implements Modifier
{
    protected HashAlgorithm $algorithm;

    public function __construct(HashAlgorithm $algorithm)
    {
        $this->algorithm = $algorithm;
    }

    public function apply(mixed $value): mixed
    {
        return match ($this->algorithm) {
            HashAlgorithm::BCRYPT => password_hash($value, PASSWORD_BCRYPT),
            HashAlgorithm::ARGON2I => password_hash($value, PASSWORD_ARGON2I),
            HashAlgorithm::ARGON2ID => password_hash($value, PASSWORD_ARGON2ID),
            HashAlgorithm::MD5 => md5($value),
            HashAlgorithm::SHA1 => sha1($value),
            HashAlgorithm::SHA256 => hash('sha256', $value),
        };
    }
}
