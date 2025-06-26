# 🧩 `populateFromArray()`

Populates the table directly from a PHP array.

## Parameters
- `data`: Array of associative arrays (records).
- `batchSize`: Number of records to insert per batch (default: 1000).

## Behavior
- Validates the array and ensures it's not empty.
- Completes any missing fields using `FieldSeeder` definitions.
- Truncates the target table.
- Inserts data in batches.
- Calls optional `beforeCallback` and `afterCallback` functions.