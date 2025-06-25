# 📂 `populateFromCsv()`

Populates the table with data from a CSV file.

## Parameters
- `csvPath`: Path to the CSV file.
- `batchSize`: Number of records to insert per batch (default: 1000).

## Behavior
- Validates the existence and readability of the CSV file.
- Truncates the target table and disables foreign key checks.
- Reads and inserts data in batches.
- Calls optional `beforeCallback` and `afterCallback` functions.
