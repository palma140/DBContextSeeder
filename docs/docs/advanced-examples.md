---
sidebar_position: 5
---

# Advanced Examples

![Texto alternativo](/img/1.png)

```php
<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use IPLeiria\ESTG\EI\DBContextSeeder\Enums\HashAlgorithm;
use IPLeiria\ESTG\EI\DBContextSeeder\TablePopulate;
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;
use Faker\Factory as Faker;

class DatabaseSeederGrocery extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = new TableSeeder('users', 'pt_PT');

        $users->bothify('field', __DIR__ . 'data.csv', 'id');

        $users->sequential('id', 1);
        $users->value('password', '123')->hash(HashAlgorithm::SHA256);
        $users->randomString('remember_token', 10);
        $users->date('created_at', 'Y-m-d H:i:s', '2023-06-22 23:05:38', '2023-07-05 10:17:38');
        $users->value('updated_at', null)
            ->generateFromField('created_at', function ($created_at) {
                return Carbon::parse($created_at)->addMinutes(rand(10, 120))->format('Y-m-d H:i:s');
            });
        $users->value('email_verified_at', null)
            ->generateFromField('updated_at', function ($updated_at) {
                return Carbon::parse($updated_at)->addMinutes(rand(10, 12000))->format('Y-m-d H:i:s');
            });
        $users->value('type', 'member')->callback(function ($type, $row) {
            if($row['id'] <= 4) return 'board';
            if($row['id'] <= 8) return 'member';
            if($row['id'] <= 12) return 'employee';
            return $type;
        });
        $users->name('name')->callback(function ($name, $row) {
            return match ($row['id']) {
                1 => "Board Member",
                2 => "Second Board Member or Admininstrator",
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
        $users->email('email')->callback(function ($email, $row) {
            if ($row['id'] <= 4) {
                return "b" . $row['id'] . "@mail.pt";
            }

            $email = match ($row['id']) {
                5 => "m1@mail.pt",
                6 => "m2@mail.pt",
                7 => "m3@mail.pt",
                8 => "m4@mail.pt",
                9 => "e1@mail.pt",
                10 => "e2@mail.pt",
                11 => "e3@mail.pt",
                12 => "e4@mail.pt",
                default => "default@mail.pt",
            };
                $names = explode(' ', $row['name']);
                return $names[0] . '.' . end($names) . '@' . Faker::create()->freeEmailDomain();
        })->removeAccents('@.')->lowercase();
        $users->boolean('blocked', 15)->callback(function ($blocked, $row) {
            if($row['id'] <= 12) return 0;
            return $blocked ? '1' : '0';
        });
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
        $users->streetAddress('default_delivery_address')->unique()->nullable(30);
        $users->array('default_payment_type', ['Visa', 'MB WAY', 'PayPal'])->nullable(20);
        $users->value('default_payment_reference', null)->callback(function ($reference, $row) {
           if($row['default_payment_type'] == 'Visa') return Faker::create()->creditCardNumber('Visa');
           if($row['default_payment_type'] == 'PayPal') return $row['email'];
           if($row['default_payment_type'] == 'MB WAY') {
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

        $users->array('gender', ['M', 'F']);

        $users->file('photo', __DIR__ . '\photos', storage_path('app/public/photos'), function ($file, $originalName, $row) {
            if($row['gender'] == 'M' && (Str::charAt($originalName, 0) == 'M' || Str::charAt($originalName, 0) == 'm')) return true;
            if($row['gender'] == 'F' && (Str::charAt($originalName, 0) == 'W' || Str::charAt($originalName, 0) == 'w')) return true;

            return false;
        }, fn($row) => null, '128M')->unique()->callback(function ($value, $row) {
            return $value;
        });

        $users->value('deleted_at', null)->generateFromField('updated_at', function ($deleted_at) {
            return Carbon::parse($deleted_at)->addMinutes(rand(900, 12000))->format('Y-m-d H:i:s');
        })->nullable(90)->callback(function ($value, $row) {
            if($row['id'] <= 12) return null;
            return $value;
        });

        $usersPopulate = new TablePopulate($users);
        $usersPopulate->populate(516, 1, 30);

        #settings_shipment_costs
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

        #settings
        $membership_fee = 100;

        $settingsSeeder = new TableSeeder('settings', 'pt_PT');
        $settingsSeeder->value('membership_fee', $membership_fee);
        $settingsSeeder->date('created_at', 'Y-m-d H:i:s', '2023-06-22 23:05:38', '2023-06-22 23:05:38');
        $settingsSeeder->date('updated_at', 'Y-m-d H:i:s', '2023-06-22 23:05:38', '2023-06-22 23:05:38');

        $settingsPopulate = new TablePopulate($settingsSeeder);
        $settingsPopulate->populate(1);

        #categories
        $categoriesSeeder = new TableSeeder('categories', 'pt_PT');
        $categoriesSeeder->array('name', [
            'Fruits',
            'Vegetables',
            'Dairy',
            'Meat',
            'Seafood',
            'Bakery',
            'Baby food',
            'Frozen foods',
            'Snacks',
            'Miscellaneous',
            'Grains',
        ], true);

        $categoriesSeeder->file('image', __DIR__ . '\categories_images', storage_path('app\public\categories_images'), function ($file, $originalName, $row) {
            if($row['name'] == 'Fruits' && explode('.', $originalName)[0] == 'fruits') return true;
            if($row['name'] == 'Vegetables' && explode('.', $originalName)[0] == 'vegetables') return true;
            if($row['name'] == 'Dairy' && explode('.', $originalName)[0] == 'dairy') return true;
            if($row['name'] == 'Grains' && explode('.', $originalName)[0] == 'grains') return true;
            if($row['name'] == 'Meat' && explode('.', $originalName)[0] == 'meat') return true;
            if($row['name'] == 'Seafood' && explode('.', $originalName)[0] == 'seafood') return true;
            if($row['name'] == 'Bakery' && explode('.', $originalName)[0] == 'bakery') return true;
            if($row['name'] == 'Baby food' && explode('.', $originalName)[0] == 'baby_food') return true;
            if($row['name'] == 'Frozen foods' && explode('.', $originalName)[0] == 'frozen_foods') return true;
            if($row['name'] == 'Snacks' && explode('.', $originalName)[0] == 'snacks') return true;
            return false;
        }, function () {}, '128M');

        $categoriesSeeder->date('created_at', 'Y-m-d H:i:s', '2023-06-22 23:05:38', '2023-06-22 23:05:38');
        $categoriesSeeder->date('updated_at', 'Y-m-d H:i:s', '2023-06-22 23:05:38', '2023-06-22 23:05:38');

        $categoriesSeeder->value('deleted_at', null)->generateFromField('updated_at', function ($deleted_at) {
            return Carbon::parse($deleted_at)->addMinutes(rand(10, 30))->format('Y-m-d H:i:s');
        })->callback(function ($value, $row) {
            if($row['name'] == 'Grains') return $value;
            return null;
        });

        $categoriesPopulate = new TablePopulate($categoriesSeeder);
        $categoriesPopulate->populate(11);

        #products
        $names = require 'Products.php';

        $transformed = [];

        foreach ($names as $categoryId => $items) {
            foreach ($items as $item) {
                $transformed[] = [
                    'name' => strtolower($item),
                    'category_id' => $categoryId
                ];
            }
        }

        $productsSeeder = new TableSeeder('products', 'pt_PT');
        $productsSeeder->text('description', 30);
        $productsSeeder->file('photo', __DIR__ . '\products_photos', storage_path('app\public\products_photos'), function ($file, $originalName, $row) {
            $normalized = strtolower(str_replace(' ', '_', $row['name']));
            if($normalized == explode('.', $originalName)[0]) return true;
            return null;
        }, function () {}, '128M');

        $productsSeeder->float('price', 1, 2, 5);
        $productsSeeder->numberBetween('stock_lower_limit', 2, 5);
        $productsSeeder->numberBetween('stock_upper_limit', 20, 50);
        $productsSeeder->value('stock', null)->callback(function ($stock, $row) {
            return max($row['stock_lower_limit'], $row['stock_upper_limit'] + mt_rand(-5, 10));
        });

        $productsSeeder->date('created_at', 'Y-m-d H:i:s', '2023-06-22 23:05:38', '2023-06-22 23:05:38');
        $productsSeeder->date('updated_at', 'Y-m-d H:i:s', '2023-06-22 23:05:38', '2023-06-22 23:05:38');

        $productsPopulate = new TablePopulate($productsSeeder);
        $productsPopulate->populateFromArray($transformed);

        #cards
        $cardsSeeder = new TableSeeder('cards', 'pt_PT');
        $cardsSeeder->sql('id', 'SELECT id FROM users WHERE type != ?', ['Employee'])->unique();
        $cardsSeeder->sequential('card_number', 100000)->callback(function ($cardNumber, $row) {
            dump($cardNumber);
            return $cardNumber;
        });
        $cardsSeeder->value('card_number', null)->generateFromField('id', function ($id) {
            return $id + 99999;
        });
        $cardsSeeder->value('balance', $membership_fee)->callback(function ($balance, $row) use ($membership_fee) {
            $valueCredited = $membership_fee + (mt_rand(0, 3) == 1 ? mt_rand(0, 100) * 5 : 0);
            return round($valueCredited - $membership_fee, 2);
        });

        $cardsPopulate = new TablePopulate($cardsSeeder);

        $cardsPopulate->populate(function () {
            return DB::table('users')
                ->where('type', '!=', 'Employee')
                ->count();
        }, 100);

        #orders
        $ordersSeeder = new TableSeeder('orders', 'pt_PT');


        #operations
        $operationsSeeder = new TableSeeder('operations', 'pt_PT');
        $operationsSeeder->sql('card_id', 'SELECT id FROM cards', []);

        $operationsPopulate = new TablePopulate($operationsSeeder);
        #$operationsPopulate->populate(5);

        #orders
        $ordersSeeder = new TableSeeder('orders', 'pt_PT');
        $ordersSeeder->value('total_items', 1);
        $ordersSeeder->sql('member_id', 'SELECT id FROM users WHERE type != ?', ['Employee']);
        $ordersSeeder->value('shipping_cost', 1);
        $ordersSeeder->address('delivery_address')->foreignKey('users', function ($row, $targetRow) {
            if($row['member_id'] == $targetRow['id']) return true;
            return false;
        }, function ($targetRow) {
            return $targetRow['default_delivery_address'];
        })->callback(function ($value, $row) {
            if($value == null) return Faker::create('pt_PT')->address();
            return $value;
        });
        $ordersSeeder->value('nif', null)->foreignKey('users', function ($row, $targetRow) {
            if($row['member_id'] == $targetRow['id']) return true;
            return false;
        }, function ($targetRow) {
            return $targetRow['nif'];
        });
        $ordersSeeder->value('total', 1);
        $ordersSeeder->timeSeries('date', '2023-07-08', '2025-05-10', function (DateTime $date) {
            $weekDay = $date->format('w');
            return [8, 15, 12, 14, 19, 30, 50][$weekDay];
        }, function (DateTime $date) {
            return [
                'date' => $date->format('Y-m-d'),
            ];
        }, deltaAvg: function (DateTime $date, $baseCount) {
            $weekDay = $date->format('w');

            $min = $baseCount + [5, 7, 5, 5, 10, 15, 30][$weekDay] * -1;
            $max = $baseCount + [5, 7, 5, 5, 10, 15, 30][$weekDay];

            return $baseCount + rand($min, $max);
        });
        $ordersSeeder->file('pdf_receipt', __DIR__ . '\receipts', storage_path('app\public\receipts'), function ($file, $originalName, $row) {return true;}, function () {}, '1G');

        $ordersPopulator = new TablePopulate($ordersSeeder);
        $ordersPopulator->populate(21000); //TODO se for null popula ate ao maximo que der

        #items_orders
        $itemsOrdersSeeder = new TableSeeder('items_orders', 'pt_PT');
        $itemsOrdersSeeder->sql('order_id', 'SELECT id FROM orders', []);
        $itemsOrdersSeeder->sql('product_id', 'SELECT id FROM products', []);

        $itemsOrdersSeeder->value('unit_price', null)->LookupModiifer('products', function ($row, $targetRow) {
            if($row['product_id'] == $targetRow['id']) return true;
            return false;
        }, function ($targetRow) {
            return $targetRow['price'];
        });
        $itemsOrdersSeeder->weightValues('quantity', [
            1 => 75,
            2 => 30,
            3 => 14,
            4 => 7,
            5 => 4,
            6 => 2,
            7 => 1,
            8 => 1,
            9 => 1,
            10 => 1,
        ]);
        $itemsOrdersSeeder->value('discount', 0)->callback(function ($value, $row) {
            $isDiscount = mt_rand(1, 25 - 2 * $row['quantity']) == 2 ? 1 : 0;
            return $isDiscount ? $row['unit_price'] * rand(1, 40)/100 : $value;
        });
        $itemsOrdersSeeder->value('subtotal', null)->callback(function ($value, $row) {
           return $row['quantity'] * ($row['unit_price'] - $row['discount']);
        });

        $itemsOrdersPopulate = new TablePopulate($itemsOrdersSeeder);
        $itemsOrdersPopulate->populate(75628, 5000, 50);

    }
}
```