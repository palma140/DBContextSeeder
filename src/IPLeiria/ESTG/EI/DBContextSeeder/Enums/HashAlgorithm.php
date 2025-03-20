<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Enums;

enum HashAlgorithm: string
{
    case BCRYPT = 'bcrypt';
    case ARGON2I = 'argon2i';
    case ARGON2ID = 'argon2id';
    case MD5 = 'md5';
    case SHA1 = 'sha1';
    case SHA256 = 'sha256';
}
