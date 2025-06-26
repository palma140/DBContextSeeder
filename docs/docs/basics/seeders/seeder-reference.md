---
sidebar_position: 15
---

# Seeders Reference

## 👤 Personal

### EmailSeeder
Generates random email addresses.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->email('email');
```

### FirstNameSeeder
Generates first names.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->firstName('first_name');
$seeder->firstName('first_name', 'male'); // or with optional gender parameter
```
### FullNameSeeder
Generates full names.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->name('name');
```

### LastNameSeeder
Generates last names.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->lastname('last_name');
$seeder->lastname('last_name', 'female'); // or with optional gender parameter
```

### PasswordSeeder
Generates passwords.

**Parameters:**
- `$min`: Minimum password length.
- `$max`: Maximum password length.

```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->password('password', $min, $max);
```

### PhoneNumberSeeder
Generates phone numbers.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->phoneNumber('phone');
```

### TitleSeeder
Generates name titles (Mr., Dr.).
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->title('title');
```

### UsernameSeeder
Generates usernames.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->username('username');
```

## 🕒 Temporal

### DateSeeder  
Generates random dates.

**Parameters:**  
- `$format` *(string|null, optional)*: The date format (e.g., `'Y-m-d'`). Default is `'Y-m-d'`.  
  See [PHP date format reference](https://www.php.net/manual/en/datetime.format.php) for supported formats.  
- `$startDate` *(string|null, optional)*: The start date for the range (e.g., `'2000-01-01'`). Default is `'1970-01-01'`.  
- `$endDate` *(string|null, optional)*: The end date for the range (e.g., `'2025-12-31'`). Default is today.

**Usage:**  
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->date('created_at', 'Y-m-d H:i:s', '2020-01-01', '2023-12-31');
```
### TimezoneSeeder
Generates timezones (e.g., UTC+1).
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->timezone('timezone');
```

## 🏢 Company

### CompanyNameSeeder
Generates company names.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->companyName('company');
```

## 💰 Currency

### CurrencyCodeSeeder
Generates currency codes (USD, EUR).
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->currencyCode('currency');
```

## 🌍 Geography

### AddressSeeder
Full address.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->address('address');
```

### BuildingNumberSeeder
Generates building numbers.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->buildingNumber('building');
```

### CitySeeder
Generates city names.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->city('city');
```

### CountrySeeder
Generates country names.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->country('country');
```

### CountryCodeSeeder
Generates country codes (e.g., PT, US).
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->countryCode('code');
```

### LatitudeSeeder
Generates latitude.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->latitude('lat');
```

### LongitudeSeeder
Generates longitude.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->longitude('lng');
```

### PostcodeSeeder
Generates postal codes.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->postcode('zip');
```

### StreetAddressSeeder
Full street address.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->streetAddress('street');
```

### StreetNameSeeder
Street names.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->streetName('street_name');
```

### StreetSuffixSeeder
Street suffixes (Ave, Rd, etc.).
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->streetSuffix('suffix');
```

## 🌐 Internet

### DomainNameSeeder
Generates domain names.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->domainName('domain');
```

### Ipv4Seeder
Random IPv4 address.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->ipv4('ip');
```

### Ipv6Seeder
Random IPv6 address.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->ipv6('ip');
```

### LocalIpv4Seeder
Local IPv4 addresses.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->localIpv4('local_ip');
```

### MacAddressSeeder
MAC addresses.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->macAddress('mac');
```

### UrlSeeder
Generates URLs.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->url('website');
```

## 🔢 Numbers

### DigitSeeder
Single random digit (0–9).
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->digit('digit');
```

### DigitNotSeeder
Digit excluding specific values.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->digitNot('digit', 4);
```

### DigitalNotNullSeeder
Non-zero digits.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->digitNotNull('digit');
```

### FloatSeeder  
Generates float values with optional precision and range.

**Parameters:**  
- `$nbMaxDecimals` *(int|null, optional)*: Number of decimal places. Default is 2.  
- `$min` *(int|null, optional)*: Minimum value. Default is 0.  
- `$max` *(int|null, optional)*: Maximum value. Default is 1000.

**Usage:**  
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->float('value', 2, 10, 500);
```

### NumberSeeder  
Generic number generation with optional digit control.

**Parameters:**  
- `$nbDigits` *(int|null, optional)*: The number of digits for the generated number. Default is `null` (no restriction).  
- `$strict` *(bool|null, optional)*: If `true`, enforces an exact digit count; if `false` or `null`, allows flexible length.

**Usage:**  
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->number('value', 5, true);
```

### NumberBetweenSeeder  
Generates numbers between a defined range.

**Parameters:**  
- `$min` *(int|null, optional)*: Minimum value of the range. Default is `null`.  
- `$max` *(int|null, optional)*: Maximum value of the range. Default is `null`.

**Usage:**  
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->numberBetween('quantity', 1, 100);
```

## 💳 Payment

### CreditCardDetailsSeeder
Generates full credit card details.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->creditCardDetails('cc');
```

### CreditCardExpirationDateSeeder
Generates expiration dates.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->creditCardExpirationDate('expiry');
```

### CreditCardNumberSeeder
Valid credit card numbers.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->creditCardNumber('number');
```

### CreditCardTypeSeeder
Card type (Visa, MasterCard, etc.).
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->creditCardType('type');
```

### IbanSeeder  
Generates valid IBANs.

**Parameters:**  
- `$countryCode` *(string|null, optional)*: Optional ISO country code to generate the IBAN for (e.g., "DE", "FR").  
- `$prefix` *(string|null, optional)*: Optional prefix to add before the IBAN.  
- `$length` *(int|null, optional)*: Optional fixed length for the generated IBAN.

**Usage:**  
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->iban('iban'); // default random IBAN  
$seeder->iban('iban', 'DE'); // IBAN for Germany  
$seeder->iban('iban', 'FR', null, 27); // IBAN for France with length 27
```

### SwiftBicNumberSeeder
Generates SWIFT/BIC codes.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->swiftBicNumber('bic');
```

## 🧪 Miscellaneous

### ArraySeeder  
Picks a random value from a given array.

**Parameters:**  
- `$value` *(array)*: The array of possible values to choose from.  
- `$useOrderedValues` *(bool, optional)*: Whether to use values in order (`true`) or pick randomly (`false`). Default is `false`.

**Usage:**  
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

// Pick random value from array
$seeder->array('choice', ['red', 'blue', 'green']);

// Pick values in order from array
$seeder->array('choice', ['red', 'blue', 'green'], true);
```

### BooleanSeeder  
Generates a random boolean value (`true` or `false`).

**Parameters:**  
- `$chanceOfGettingTrue` *(int|null, optional)*: Probability (0–100) of returning `true`. Default is 50 (equal chance).

**Usage:**  
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

// 50% chance of true or false
$seeder->boolean('flag');

// 70% chance to get true
$seeder->boolean('flag', 70);
```

### CsvSeeder  
Extracts values from a CSV file.

**Parameters:**  
- `$csvFile` *(string)*: The path to the CSV file.
- `$target_csv_column` *(string)*: The column name or index to extract values from.  

**Usage:**  
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->csv('field', __DIR__ . 'data.csv', 'id');
```

### EmojiSeeder
Generates emojis.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->emoji('emoji');
```

### File Seeder

Reads values from a file and applies logic for selection and renaming.

**Parameters:**
- `string $field`: The name of the field.
- `string $source`: Path to the source directory or identifier.
- `string $destination`: Path to the destination directory or identifier.
- `Closure|null $callback`: Optional callback to process each file.
- `Closure|null $renameCallback`: Optional callback to rename the file.
- `string|null $memoryLimit`: Optional memory limit for the seeding process.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$users->file(
    'photo',
    __DIR__ . DIRECTORY_SEPARATOR . 'photos',
    storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'photos'),
    function ($file, $originalName, $row) {
        if ($row['gender'] == 'M' && (Str::charAt($originalName, 0) == 'M' || Str::charAt($originalName, 0) == 'm')) {
            return true;
        }
        if ($row['gender'] == 'F' && (Str::charAt($originalName, 0) == 'W' || Str::charAt($originalName, 0) == 'w')) {
            return true;
        }
        return false;
    },
    function () {
        return Str::random(32);
    },
    '128M'
)->unique();

```

### LanguageCodeSeeder
ISO language codes (e.g., en, pt).
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->languageCode();
```

### LocaleSeeder
Locale codes (e.g., pt_PT, en_US).
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->locale('locale');
```

### Md5Seeder
Generates MD5 hashes.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->md5('value');
```

### SequentialNumberSeeder  
Generates incrementing numbers.

**Parameters:**  
- `$start` *(int, optional)*: The starting number for the sequence. Defaults to 1.

**Usage:**  
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->sequentialNumber('id', 100); // Starts counting from 100
```

### Sha1Seeder
SHA1 hashes.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->sha1('value');
```

### Sha256Seeder
SHA256 hashes.
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->sha256('value');
```

### SqlSeeder  
Executes raw SQL to fetch values.

**Parameters:**  
- `$query` *(string)*: The SQL query to execute.  
- `$bindings` *(array, optional)*: The bindings for the SQL query.
- `$preserveOrder` *(optional, default false)* — Whether to preserve the original order of the SQL results.

**Usage:**  
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->sql('name', 'SELECT name FROM users WHERE active = ?', [1], false);
```

### TimeSeriesSeeder  
Generates time-based sequences (e.g., for charts).

**Parameters:**  
- `$startDate` *(string)*: The start date for the time series.  
- `$endDate` *(string)*: The end date for the time series.  
- `$granularity` *(string, optional)*: Granularity of the series, defaults to `'daily'`.
- `$entriesPerPeriod` *(callable)*: A function returning the number of entries per period.  
- `$entryFactory` *(callable)*: A factory function to create each entry.  
- `$deltaAvg` *(callable)*: A function to compute average delta between entries.  

**Usage:**  
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->timeSeries('date', '2023-07-08', '2025-05-10', function (DateTime $date) {
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

```

### ValueSeeder  
Static or fixed value.

**Parameters:**  
- `$value` *(mixed)*: The value to set for the field.

**Usage:**  
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->value('status', 'active');
```

### WeightValuesSeeder  
Picks from a weighted distribution.

**Parameters:**  
- `$weights` *(array)*: An associative array where keys are values and values are their weights.

**Usage:**  
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->weightValues('color', ['red' => 90, 'blue' => 20, 'green' => 10]);
```

## ✏️ Text

### BothifySeeder  
Generates a string based on a pattern, replacing `?` with random letters and `#` with digits.

**Parameters:**  
- `$pattern` *(string)*: The pattern to use (e.g., `'??-###'`).

**Usage:**  
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->bothify('code', '??-###'); // Might generate something like 'AB-593'
```

### LexifySeeder  
Generates a random string by replacing `?` in the pattern with random letters (a–z).

**Usage:**
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->lexify('code', '???-???');
```

### LetterSeeder  
Generates a single random letter (a–z). Supports uniqueness if required.

**Usage:**
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->letter('initial');
```

### RandomStringSeeder  
Generates random alphanumeric strings of a specified length. Ensures uniqueness if required.

**Parameters:**
- `$string_size` *(int|null, optional)*: The length of the random string. Default is 16 if not set explicitly.

**Usage:**
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->randomString('token', 32);
```

### TextSeeder  
Generates random text content with a character limit. Ensures uniqueness if required.

**Parameters:**
- `$maxCharacters` *(int)*: The maximum number of characters in the generated text.

**Usage:**
```php
use IPLeiria\ESTG\EI\DBContextSeeder\TableSeeder;

$seeder->text('description', 200);
```