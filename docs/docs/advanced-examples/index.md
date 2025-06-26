---
sidebar_position: 5
---

# Code explained

![Sample Image](/img/1.png)

---

## 1. Users Seeder

```php
<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Enums\HashAlgorithm;
use IPLeiria\ESTG\EI\DBContextSeeder\TablePopulate;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class DatabaseSeederGrocery extends Seeder
{
    public function run(): void
    {
        $users = new TableSeeder('users', 'en_US');

        // Basic settings and CSV for IDs
        $users->bothify('field', __DIR__ . 'data.csv', 'id');
        $users->sequential('id', 1);

        // Password and token
        $users->value('password', '123')->hash(HashAlgorithm::SHA256);
        $users->randomString('remember_token', 10);

        // Created and updated dates
        $users->date('created_at', 'Y-m-d H:i:s', '2023-06-22 23:05:38', '2023-07-05 10:17:38');
        $users->value('updated_at', null)
            ->generateFromField('created_at', function ($created_at) {
                return Carbon::parse($created_at)->addMinutes(rand(10, 120))->format('Y-m-d H:i:s');
            });
        $users->value('email_verified_at', null)
            ->generateFromField('updated_at', function ($updated_at) {
                return Carbon::parse($updated_at)->addMinutes(rand(10, 12000))->format('Y-m-d H:i:s');
            });

        // User types with conditional callback
        $users->value('type', 'member')->callback(function ($type, $row) {
            if ($row['id'] <= 4) return 'board';
            if ($row['id'] <= 8) return 'member';
            if ($row['id'] <= 12) return 'employee';
            return $type;
        });

        // Custom names for first IDs
        $users->name('name')->callback(function ($name, $row) {
            return match ($row['id']) {
                1 => "Board Member",
                2 => "Second Board Member or Administrator",
                3 => "Third Board Member",
                4 => "Fourth Board Member",
                5 => "Regular Member",
                6 => "Second Regular Member",
                7 => "Third Regular Member",
                8 => "Fourth Regular Member",
                9 => "First Employee",
                10 => "Second Employee",
                11 => "Third Employee",
                12 => "Fourth Employee",
                default => $name,
            };
        });

        // **Emails generated based on first and last name**
        $users->email('email')->callback(function ($email, $row) {
            if ($row['id'] <= 4) {
                return "b" . $row['id'] . "@mail.com";
            }

            $email = match ($row['id']) {
                5 => "m1@mail.com",
                6 => "m2@mail.com",
                7 => "m3@mail.com",
                8 => "m4@mail.com",
                9 => "e1@mail.com",
                10 => "e2@mail.com",
                11 => "e3@mail.com",
                12 => "e4@mail.com",
                default => "default@mail.com",
            };

            // Generate email as first.last@domain
            $names = explode(' ', $row['name']);
            return $names[0] . '.' . end($names) . '@' . Faker::create()->freeEmailDomain();
        })->removeAccents('@.')->lowercase();

        // Blocked flag with condition
        $users->boolean('blocked', 15)->callback(function ($blocked, $row) {
            if ($row['id'] <= 12) return 0;
            return $blocked ? '1' : '0';
        });

        // NIF with control digit calculation
        $users->value('nif', function () {
            $nif = '';
            for ($i = 0; $i < 8; $i++) {
                $nif .= rand(0, 9);
            }
            $weights = [9, 8, 7, 6, 5, 4, 3, 2];
            $sum = 0;
            for ($i = 0; $i < 8; $i++) {
                $sum += $nif[$i] * $weights[$i];
            }
            $remainder = $sum % 11;
            $controlDigit = (11 - $remainder) % 10;
            $nif .= $controlDigit;
            return $nif;
        })->nullable(20);

        // Address, payments etc.
        $users->streetAddress('default_delivery_address')->unique()->nullable(30);
        $users->array('default_payment_type', ['Visa', 'MB WAY', 'PayPal'])->nullable(20);

        $users->value('default_payment_reference', null)->callback(function ($reference, $row) {
            if ($row['default_payment_type'] == 'Visa') return Faker::create()->creditCardNumber('Visa');
            if ($row['default_payment_type'] == 'PayPal') return $row['email'];
            if ($row['default_payment_type'] == 'MB WAY') {
                $prefixes = ['91', '92', '93', '96', '97', '98'];
                $prefix = $prefixes[array_rand($prefixes)];
                $phoneNumber = $prefix;
                for ($i = 0; $i < 7; $i++) {
                    $phoneNumber .= rand(0, 9);
                }
                return $phoneNumber;
            }
            return null;
        });

        // Gender for photo filtering
        $users->array('gender', ['M', 'F']);

        // **Photo files based on gender and initial letter of file**
        $users->file('photo', __DIR__ . DIRECTORY_SEPARATOR . 'photos', storage_path('app/public/photos'), function ($file, $originalName, $row) {
            if ($row['gender'] == 'M' && (Str::charAt($originalName, 0) == 'M' || Str::charAt($originalName, 0) == 'm')) {
                return true;
            }
            if ($row['gender'] == 'F' && (Str::charAt($originalName, 0) == 'F' || Str::charAt($originalName, 0) == 'f')) {
                return true;
            }
            return false;
        });

        $users->populate();
    }
}
```
## 2. Products Seeder
```php
<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use IPLeiria\ESTG\EI\DBContextSeeder\TablePopulate;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        $productsSeeder = new TableSeeder('products', 'en_US');

        $productsSeeder->sequential('id', 1);
        $productsSeeder->text('name', 50);
        $productsSeeder->text('description', 150);
        $productsSeeder->float('price', 1, 2, 100);  // Price from 1 to 100
        $productsSeeder->numberBetween('stock_lower_limit', 5, 10);
        $productsSeeder->numberBetween('stock_upper_limit', 20, 50);
        $productsSeeder->value('stock', null)->callback(function ($stock, $row) {
            return max($row['stock_lower_limit'], $row['stock_upper_limit'] + mt_rand(-5, 10));
        });
        $productsSeeder->date('created_at', 'Y-m-d H:i:s', '2023-01-01 00:00:00', '2023-06-01 00:00:00');
        $productsSeeder->date('updated_at', 'Y-m-d H:i:s', '2023-06-02 00:00:00', '2023-07-01 00:00:00');

        // Example callback to make some products have a deleted_at date
        $productsSeeder->value('deleted_at', null)->generateFromField('updated_at', function ($updated_at) {
            return Carbon::parse($updated_at)->addDays(rand(10, 60))->format('Y-m-d H:i:s');
        })->nullable(20)->callback(function ($value, $row) {
            // 20% chance product is deleted
            return (rand(1, 100) <= 20) ? $value : null;
        });

        $productsPopulate = new TablePopulate($productsSeeder);

        // Example fixed products to populate from array, you can customize this
        $productsArray = [
            ['name' => 'apple', 'description' => 'Fresh red apple', 'price' => 1.50, 'stock_lower_limit' => 5, 'stock_upper_limit' => 20],
            ['name' => 'banana', 'description' => 'Yellow ripe bananas', 'price' => 1.20, 'stock_lower_limit' => 5, 'stock_upper_limit' => 25],
            ['name' => 'milk', 'description' => 'Dairy milk 1L', 'price' => 0.99, 'stock_lower_limit' => 10, 'stock_upper_limit' => 30],
            ['name' => 'bread', 'description' => 'Whole grain bread', 'price' => 2.50, 'stock_lower_limit' => 5, 'stock_upper_limit' => 15],
        ];

        $productsPopulate->populateFromArray($productsArray);
    }
}
```

## 3. Categories Seeder
```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\TablePopulate;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    use SeederUtils;

    // Static list of categories to seed, where each entry has an ID and a name
    public static $categories = [
        1 => 'Fruits',
        2 => 'Vegetables',
        3 => 'Dairy',
        4 => 'Meat',
        5 => 'Seafood',
        6 => 'Bakery',
        7 => 'Baby food',
        8 => 'Frozen foods',
        9 => 'Snacks',
        10 => 'Miscellaneous',
        11 => 'Grains',
    ];

    /**
     * Main method executed when running this seeder with `php artisan db:seed`
     */
    public function run(): void
    {
        $this->command->info("-----------------------------------------------------------------");
        $this->command->info("START of categories seeder");
        $this->command->info("-----------------------------------------------------------------");

        $this->command->info("\n-----------------------------------------------");
        $this->command->info("START of categories table seeder");

        // Convert the static categories list into an array of associative arrays
        $categoriesArray = [];
        foreach (self::$categories as $categoryId => $categoryName) {
            $categoriesArray[] = [
                'id' => $categoryId,
                'name' => $categoryName,
            ];
        }

        // Create the seeder for the 'categories' table with Portuguese locale
        $categoriesSeeder = new TableSeeder('categories', 'pt_PT');

        // Add file attachment to the 'image' column, copying from source to destination if it matches the category name
        $categoriesSeeder->file(
            'image',
            __DIR__ . DIRECTORY_SEPARATOR . 'categories_images',                      // Source directory (inside seeder folder)
            storage_path('app/public/categories_images'),        // Destination directory in Laravel storage
            function ($file, $originalName, $row) {
                // Match image filename (without extension) with category name
                return str_replace(' ', '_', strtolower($this->stripAccents($row['name']))) === strtolower(explode('.', $originalName)[0]);
            },
            function () {
                // Generate a random 32-character string for filename
                return Str::random(32) . ".png";
            },
            '128M' // Max memory for loading images
        );

        // Add 'created_at' with a random date between the given range
        $categoriesSeeder->date(
            'created_at',
            'Y-m-d H:i:s',
            DatabaseSeeder::$prepareStartDate,
            DatabaseSeeder::$prepareEndDate->subHours(2)
        );

        // Generate 'updated_at' based on 'created_at' plus 10–30 minutes
        $categoriesSeeder->value('updated_at', null)->generateFromField('created_at', function ($created_at) {
            return Carbon::parse($created_at)->addSeconds(rand(600, 1800))->format('Y-m-d H:i:s');
        });

        // Generate 'deleted_at' based on 'updated_at' plus 10–30 minutes, but only for the 'Grains' category
        $categoriesSeeder->value('deleted_at', null)->generateFromField('updated_at', function ($updated_at) {
            return Carbon::parse($updated_at)->addSeconds(rand(600, 1800))->format('Y-m-d H:i:s');
        })->callback(function ($value, $row) {
            // Only apply deletion timestamp to the "Grains" category
            return $row['name'] === 'Grains' ? $value : null;
        });

        // Initialize the populate process with the array of categories
        $categoriesPopulate = new TablePopulate($categoriesSeeder);
        $categoriesPopulate->populateFromArray($categoriesArray);

        $this->command->info("END of categories table seeder");
        $this->command->info("-----------------------------------------------");
    }
}
```