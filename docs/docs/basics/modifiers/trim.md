---
sidebar_position: 12
---

# ✂️ Trim

Removes whitespace from both ends of the value.

---

## Example Usage

```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->value('name', '  John  ')->trim(); // "John"
