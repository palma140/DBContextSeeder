# 📄 TablePopulate - High-Level Overview

`TablePopulate` is a powerful utility class designed to streamline and standardize the population of database tables in Laravel-based applications. It plays a central role in the **DBContextSeeder** system, providing an extensible interface to populate tables with large volumes of data—either for testing, simulations, or preloading content.

## 🌟 Key Features

- **Flexible Input Sources:** Supports seeding data from arrays, callable seeders.
- **Batch Insertion:** Efficiently inserts data in configurable batch sizes to reduce memory usage and increase performance.
- **Retry Mechanism:** Automatically retries failed insertions, helping mitigate transient database issues.
- **Pre/Post Hooks:** Provides before/after callbacks for custom logic (e.g., logging, cache clearing) during the population process.
- **Foreign Key Handling:** Automatically disables/enables foreign key checks around inserts for clean truncation and reseeding.

## 🧠 Core Concepts

### `TableSeeder` Integration
The `TablePopulate` class depends on a `TableSeeder`, which defines:
- The target table name
- A mapping of field names to their corresponding seeder logic

This separation of concerns makes it easy to reuse and customize seeding logic across different datasets.

### Callbacks
You can attach `before()` and `after()` callbacks to inject behavior at key points in the seeding lifecycle, offering a high degree of control.

```php
$seeder = new TableSeeder('table', 'en_US');
(...)
$populator = new TablePopulate($seeder);
$populator->before(fn() => echo "Starting...")
          ->after(fn() => echo "Done!")
          ->populate(1000); // Populates 1000 entries
