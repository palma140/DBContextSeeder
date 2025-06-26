---
sidebar_position: 7
---

# ❓ Nullable

Randomly sets values to null based on a percentage (0–100).

---

## Example Usage

```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->phoneNumber('phone')->nullable(30); // 30% chance to be null
