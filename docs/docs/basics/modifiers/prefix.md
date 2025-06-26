---
sidebar_position: 8
---

# ⬅️ Prefix

Adds a prefix to the value.

---

## Example Usage

```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->value('code', '123')->prefix('INV-'); // "INV-123"
