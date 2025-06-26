---
sidebar_position: 2
---

# 🔍 Lookup

The **LookupModifier** replaces the value of a field by looking up related data from another table.

This modifier is useful when you want to populate a field based on a relation or reference to another dataset.

---

## Example Usage

```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$itemsSeeder->value('unit_price', null)->LookupModifier('products',
    // Callback to find the matching row in the 'products' table
    function ($row, $targetRow) {
        return $row['product_id'] == $targetRow['id'];
    },
    // Callback to return the desired value from the matched 'products' row
    function ($targetRow) {
        return $targetRow['price'];
    }
);
```
## Explanation of Callbacks

### First callback — Matching function

This function receives the current row (`$row`) and a candidate target row (`$targetRow`) from the related table ('products').  
It returns `true` if the target row matches the criteria; in this example, it checks if the `product_id` in the current row matches the `id` of the product row.
s
```php
function ($row, $targetRow) {
    return $row['product_id'] == $targetRow['id'];
}
```

### Second callback — Value extraction function

Once the matching target row is found, this function receives that row and returns the value to be assigned to the field.
In the example, it returns the `price` from the matched product row.
```php
function ($targetRow) {
    return $targetRow['price'];
}
```