---
sidebar_position: 2
---

# 📦 Basic Usage

The `DBContextSeeder` is simple and intuitive to use. To get started, initialize a `TableSeeder` by providing the target table name and desired locale:

```php
$tableSeeder = new TableSeeder('table', 'pt_PT');
```

You can then use the available fluent methods to define your data seeding logic:

```php
$tableSeeder->name('name')->unique();
```

### 📧 Example: Email Field with Custom Logic

```php
$tableSeeder->email('email')
    ->unique()
    ->callback(function ($value, $row) {
        $strings = explode(' ', $row['name']);
        return $strings[0] . '.' . ($strings[1] ?? '') . '.' . ($strings[2] ?? '') .
               rand(1950, 2020) . '@' . (rand(0, 1) === 0 ? 'gmail.com' : 'email.com');
    })
    ->lowercase()
    ->removeAccents();
```

### 🔐 Example: Hashed Password

```php
$tableSeeder->value('password', '123')->hash();
```

This approach ensures that each field can be customized easily with chaining methods, making your seeders both readable and flexible. 💡
