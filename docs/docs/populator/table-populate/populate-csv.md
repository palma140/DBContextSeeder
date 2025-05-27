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

---

## 📄 `populateFromJSON(string $jsonPath, int $batchSize = 1000)`

Populates the table with data from a JSON file.

### Parameters
- `jsonPath`: Path to the JSON file.
- `batchSize`: Number of records to insert per batch (default: 1000).

### Behavior
- Validates the existence, readability, and structure of the JSON file.
- Expects an array of associative arrays (records).
- Truncates the table and inserts the data in batches.
- Calls optional `beforeCallback` and `afterCallback` functions.

---