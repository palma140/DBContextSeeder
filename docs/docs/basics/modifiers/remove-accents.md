---
sidebar_position: 9
---

# RemoveAccents

Removes accents from characters, optionally excluding specific ones.

---

**Example:**

```php
$seeder->name('name')->removeAccents(['ç']); //removes all accents, ignoring 'ç'
