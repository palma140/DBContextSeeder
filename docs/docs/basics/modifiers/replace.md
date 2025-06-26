---
sidebar_position: 10
---

# 🔁 Replace

Replaces parts of the string using str_replace.

---

## Example Usage

```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->value('status', 'pending')->replace('pending', 'awaiting'); //replaces status with awaiting
