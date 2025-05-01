<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Enums;

/**
 * Enum HashAlgorithm
 *
 * Represents the supported hashing algorithms that can be used for password or data hashing.
 *
 * @package IPLeiria\ESTG\EI\DBContextSeeder\Enums
 */
enum HashAlgorithm: string
{
    /**
     * BCRYPT hashing algorithm.
     * Recommended for secure password hashing.
     */
    case BCRYPT = 'bcrypt';

    /**
     * ARGON2I hashing algorithm.
     * Memory-hard algorithm suitable for password hashing.
     */
    case ARGON2I = 'argon2i';

    /**
     * ARGON2ID hashing algorithm.
     * Hybrid of Argon2i and Argon2d; recommended over ARGON2I.
     */
    case ARGON2ID = 'argon2id';

    /**
     * MD5 hashing algorithm.
     * Fast but not secure; not recommended for sensitive data.
     */
    case MD5 = 'md5';

    /**
     * SHA1 hashing algorithm.
     * Obsolete for security purposes due to known vulnerabilities.
     */
    case SHA1 = 'sha1';

    /**
     * SHA256 hashing algorithm.
     * Part of the SHA-2 family; more secure than MD5 and SHA1.
     */
    case SHA256 = 'sha256';
}
