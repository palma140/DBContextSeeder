---
sidebar_position: 1
---
# 🔁 `populate()`

The `populate()` method is designed to bulk insert records into a database table efficiently and safely, with support for batching and retries on failure.

## Description

- Inserts a specified number of records into the target table.
- Performs the insertion in batches to optimize performance and avoid memory issues.
- Retries batch inserts on failure, with a configurable number of attempts.
- Supports dynamic determination of the total record count via a callback.
- Truncates the table before inserting new records (disables foreign key checks temporarily).
- Allows optional verbose error output for debugging.
- Executes optional callbacks before and after the population process.

## Parameters

| Parameter     | Type          | Default  | Description                                                                                     |
|---------------|---------------|----------|-------------------------------------------------------------------------------------------------|
| `$count`      | `int|callable`| Required | Number of records to insert or a callable returning that number.                                |
| `$batchSize`  | `int`         | 1000     | Number of records inserted per batch.                                                          |
| `$maxRetries` | `int`         | 1        | Maximum number of retry attempts for a batch if insertion fails.                               |
| `$verbose`    | `bool`        | false    | If `true`, shows detailed error messages when a batch insertion fails.                         |

## Behavior

1. If `$count` is a callable, it is executed to get the integer count.
2. The target table is truncated before insertion (foreign key checks are disabled and re-enabled).
3. Records are generated and inserted in batches of size `$batchSize`.
4. On failure, the insertion is retried up to `$maxRetries`.
5. If retries are exhausted, an exception is thrown.
6. During retry, stateful seeders like `SequentionalNumberSeeder` have their counters reset to avoid inconsistent data.
7. Optional callbacks before and after population are executed if set.
8. Status messages are printed to the console, showing progress and errors.


## Exceptions

- Throws `InvalidArgumentException` if `$count` is not an integer or a callable returning an integer.
- Throws `Exception` if batch insertion repeatedly fails after max retries.

---

## 🔁 Common Features

- All methods truncate the table before inserting new data.
- Batches are used to optimize performance and memory usage.
- `beforeCallback` and `afterCallback` hooks allow custom logic before and after population.
- Foreign key checks are temporarily disabled during truncation to avoid constraint issues.

---