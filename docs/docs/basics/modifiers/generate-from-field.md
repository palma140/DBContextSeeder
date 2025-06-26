---
sidebar_position: 4
---

# 🛠️ GenerateFromField

The `GenerateFromField` modifier creates or modifies a field's value based on the value of another field in the same row.

You specify the source field and a callback function that takes the source field's value and returns the new value for the target field.

---

## Example Usage

```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->value('username', null)->GenerateFromField('name', function ($name) {
    return strtolower(str_replace(' ', '.', $name));
});
