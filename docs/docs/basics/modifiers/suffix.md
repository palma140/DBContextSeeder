---
sidebar_position: 8
---

# ➡️ Sufix

Adds a suffix to the value.

---

## Example Usage

```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->value('code', '123')->sufix('INV-'); // "123INV-"
