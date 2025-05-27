---
sidebar_position: 12
---

# Unique

Ensures all values generated for this column are unique.

---

**Example:**

```php
$seeder->email('email')->unique(); //tells faker that it should generate only unique emails
```
## ⚠️ Warning

The `unique` modifier might not be supported by all seeder types—particularly those that don't rely on Faker—or in new and custom implementations. Use it with caution and thoroughly test your seeders.
