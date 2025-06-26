---
sidebar_position: 0
---

# 🧮 Basic Usage

To begin using `TablePopulate`, simply create an instance by passing in the corresponding `TableSeeder`:

```php
use IPLeiria\ESTG\EI\DBContextSeeder\TablePopulate;

$itemsOrdersPopulate = new TablePopulate($itemsOrdersSeeder);
```

Once initialized, you can call the `populate()` method with the appropriate parameters for your use case:

```php
$itemsOrdersPopulate->populate(75628, 5000, 50);
```

---

### 📥 Importing Data from Other Sources

You can also populate tables from various external data sources using one of the following methods:

- `populateFromCsv(string $path, int $batchSize)`
- `populateFromJson(string $path, int $batchSize)`
- `populateFromArray(array $data, int $batchSize)`

---

### 🧾 Example: Using `populateFromArray`

```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\TablePopulate;

$settingsShippingSeeder = new TableSeeder('settings_shipping_costs', 'pt_PT');

$settingsShippingSeeder->date('created_at', 'Y-m-d H:i:s', '2023-06-22 23:05:38', '2023-06-22 23:05:38');
$settingsShippingSeeder->date('updated_at', 'Y-m-d H:i:s', '2023-06-22 23:05:38', '2023-06-22 23:05:38');

$settingsShipping = [
    [
        'min_value_threshold' => 0,
        'max_value_threshold' => 50,
        'shipping_cost' => 10,
    ],
    [
        'min_value_threshold' => 50,
        'max_value_threshold' => 100,
        'shipping_cost' => 5,
    ],
    [
        'min_value_threshold' => 100,
        'max_value_threshold' => 9999999.99,
        'shipping_cost' => 0,
    ]
];

$settingsShippingPopulate = new TablePopulate($settingsShippingSeeder);
$settingsShippingPopulate->populateFromArray($settingsShipping);
```

This approach is ideal when you already have structured data and want to seed it directly into the database with full control. ⚙️
