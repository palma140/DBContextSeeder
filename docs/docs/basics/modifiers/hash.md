---
sidebar_position: 15
---

# Hash

The **hash** modifier transforms the generated value into a hashed string using one of several supported algorithms.

Supported hashing algorithms:

| Algorithm    | Description                            | PHP Implementation                          |
|--------------|------------------------------------|--------------------------------------------|
| BCRYPT       | Strong password hashing algorithm  | `password_hash($value, PASSWORD_BCRYPT)`   |
| ARGON2I      | Memory-hard password hashing        | `password_hash($value, PASSWORD_ARGON2I)`  |
| ARGON2ID     | Improved Argon2 variant              | `password_hash($value, PASSWORD_ARGON2ID)` |
| MD5          | MD5 hashing  | `md5($value)`                       |
| SHA1         | SHA-1 hashing         | `sha1($value)`                            |
| SHA256       | SHA-256 hashing                      | `hash('sha256', $value)`                   |

By default, the modifier uses the BCRYPT algorithm.

---

## Example Usage

```php
$seeder->value('password', '123')->hash(); // BCRYPT
```
Or
```php
$seeder->value('password', '123')->hash(HashAlgorithm::SHA256); // SHA256
```