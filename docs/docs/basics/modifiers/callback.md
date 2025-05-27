---
sidebar_position: 1
---

# Callback

Applies a user-defined callback to the generated value.

**Parameters:**
- `$value`: The current generated value.
- `$row`: The array with all previously generated values in the current row.

**Example:**

```php
$seeder->email('email')->callback(function ($value, $row) {
    $name = explode(' ', $row['name']);
    return strtolower($name[0] . '.' . ($name[1] ?? '') . '@email.com');
});
```

## ⚠️ Warning
When generating multiple records, if your callback function frequently produces duplicate values for fields that must be unique in the database, you should either increase the number of retries allowed by the populator or modify the callback to reduce collisions. Otherwise, insert operations may fail due to unique constraint violations.