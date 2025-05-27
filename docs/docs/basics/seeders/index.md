---
sidebar_position: 2
---

# Available Types of Data Generation

DBContextSeeder provides a wide set of built-in seeders organized by category. Each seeder represents a **type of data** that can be automatically generated and inserted into your database.

Use these seeders with the `TableSeeder` fluent API to quickly define realistic and diverse data for testing and development.

---

## 📇 Personal

| Seeder              | Description                      |
|---------------------|----------------------------------|
| `EmailSeeder`       | Generates random email addresses |
| `FirstNameSeeder`   | Generates first names            |
| `FullNameSeeder`    | Generates full names             |
| `LastNameSeeder`    | Generates last names             |
| `PasswordSeeder`    | Generates or hashes passwords    |
| `PhoneNumberSeeder` | Generates phone numbers          |
| `TitleSeeder`       | Generates name titles (Mr., Dr.) |
| `UsernameSeeder`    | Generates usernames              |

---

## 🕒 Temporal

| Seeder             | Description                          |
|--------------------|--------------------------------------|
| `DateSeeder`       | Generates random dates               |
| `TimezoneSeeder`   | Generates timezones (e.g., UTC+1)    |

---

## 🏢 Company

| Seeder               | Description                 |
|----------------------|-----------------------------|
| `CompanyNameSeeder`  | Generates company names     |

---

## 💰 Currency

| Seeder               | Description                      |
|----------------------|----------------------------------|
| `CurrencyCodeSeeder` | Generates currency codes (USD, EUR) |

---

## 🌍 Geography

| Seeder                 | Description                      |
|------------------------|----------------------------------|
| `AddressSeeder`        | Full address                    |
| `BuildingNumberSeeder` | Generates building numbers       |
| `CitySeeder`           | Generates city names             |
| `CountrySeeder`        | Country names                    |
| `CountryCodeSeeder`    | Country codes (e.g., PT, US)     |
| `LatitudeSeeder`       | Generates latitude               |
| `LongitudeSeeder`      | Generates longitude              |
| `PostcodeSeeder`       | Generates postal codes           |
| `StreetAddressSeeder`  | Full street address              |
| `StreetNameSeeder`     | Street names                     |
| `StreetSuffixSeeder`   | Street suffixes (Ave, Rd, etc.)  |

---

## 🌐 Internet

| Seeder              | Description                        |
|---------------------|------------------------------------|
| `DomainNameSeeder`  | Generates domain names             |
| `Ipv4Seeder`        | Random IPv4 address                |
| `Ipv6Seeder`        | Random IPv6 address                |
| `LocalIpv4Seeder`   | Local IPv4 addresses               |
| `MacAddressSeeder`  | MAC addresses                      |
| `UrlSeeder`         | Generates URLs                     |

---

## 🔢 Numbers

| Seeder                 | Description                             |
|------------------------|-----------------------------------------|
| `DigitSeeder`          | Single random digit (0–9)               |
| `DigitNotSeeder`       | Digit excluding specific values         |
| `DigitalNotNullSeeder` | Non-zero digits                         |
| `FloatSeeder`          | Float values with optional precision    |
| `NumberSeeder`         | Generic number generation               |
| `NumberBetweenSeeder`  | Numbers between a defined range         |

---

## 💳 Payment

| Seeder                        | Description                          |
|-------------------------------|--------------------------------------|
| `CreditCardDetailsSeeder`     | Generates full credit card details   |
| `CreditCardExpirationDateSeeder` | Generates expiration dates       |
| `CreditCardNumberSeeder`      | Valid credit card numbers            |
| `CreditCardTypeSeeder`        | Card type (Visa, MasterCard, etc.)  |
| `IbanSeeder`                  | Generates valid IBANs                |
| `SwiftBicNumberSeeder`        | Generates SWIFT/BIC codes            |

---

## 🧪 Miscellaneous

| Seeder                  | Description                                      |
|-------------------------|--------------------------------------------------|
| `ArraySeeder`           | Picks random value from array                    |
| `BooleanSeeder`         | Random boolean (true/false)                      |
| `CsvSeeder`             | Extracts values from CSV                         |
| `EmojiSeeder`           | Generates emojis                                 |
| `FileSeeder`            | Reads values from a file                         |
| `LanguageCodeSeeder`    | ISO language codes (e.g., en, pt)                |
| `LocaleSeeder`          | Locale codes (e.g., pt_PT, en_US)                |
| `Md5Seeder`             | Generates MD5 hashes                             |
| `SequentialNumberSeeder`| Generates incrementing numbers                   |
| `Sha1Seeder`            | SHA1 hashes                                      |
| `Sha256Seeder`          | SHA256 hashes                                    |
| `SqlSeeder`             | Executes raw SQL to fetch values                 |
| `TimeSeriesSeeder`      | Generates time-based sequences (e.g., for charts)|
| `ValueSeeder`           | Static or fixed value                            |
| `WeightValuesSeeder`    | Picks from a weighted distribution               |

---

## ✏️ Text

| Seeder                  | Description                                      |
|-------------------------|--------------------------------------------------|
| `BothifySeeder`           | Generates a string based on a pattern                    |
| `LexifySeeder`         | Generates a string based on a pattern                      |
| `LetterSeeder`             |Generates a random letter                         |
| `RandomStringSeeder`           | Generates a string of a given size                                 |
| `TextSeeder`            | Generates text of a given size                         |

---

## 🧠 Tip

You don’t have to use these classes directly. Instead, use the convenient fluent syntax from `TableSeeder`:

```php
$seeder = new TableSeeder('table', 'en_US');
$seeder->email('email');
$seeder->value('password', '123');
$seeder->weightValues('type', ['admin' => 1, 'user' => 10]);
