<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder;

use Closure;
use Exception;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Company\CompanySeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Financial\CurrencyCodeSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography\AddressSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography\BuildingNumber;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography\CitySeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography\CountrySeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography\LatitudeSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography\LongitudeSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography\PostcodeSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography\StreetAddressSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography\StreetNameSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography\StreetSuffixSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Internet\DomainNameSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Internet\Ipv4Seeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Internet\Ipv6Seeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Internet\LocalIpv4Seeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Internet\MacAddressSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Internet\UrlSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous\ArraySeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous\BooleanSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous\CsvSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous\EmojiSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous\FileSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous\LanguageCodeSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous\Md5Seeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous\TimeSeriesSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Text\TextSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous\SequentionalNumberSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous\Sha1Seeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous\Sha256Seeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous\SqlSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous\ValueSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous\WeightValuesSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Numbers\DigitNotNullSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Numbers\DigitNotSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Numbers\DigitSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Numbers\FloatSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Numbers\NumberBetweenSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Numbers\NumberSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Payment\CreditCardDetailsSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Payment\CreditCardExpirationDateSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Payment\CreditCardNumberSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Payment\CreditCardTypeSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Payment\IbanSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Payment\SwiftBicNumberSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal\EmailSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal\FirstNameSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal\FullNameSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal\LastNameSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal\PasswordSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal\PhoneNumberSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal\TitleSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal\UsernameSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Temporal\DateSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Temporal\TimezoneSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Text\BothifySeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Text\LetterSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Text\LexifySeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Text\RandomStringSeeder;

class TableSeeder
{
    /**
     * @var string $table The table name to seed data into.
     */
    protected string $table;

    /**
     * @var array $fields Associative array of fields to be seeded with corresponding seeders.
     */
    protected array $fields = [];

    /**
     * @var string $language Language used for seeding (optional).
     */
    protected string $language;

    /**
     * TableSeeder constructor.
     *
     * @param string $table The name of the table.
     * @param string $language The language for the seeded data.
     */
    public function __construct(string $table, string $language)
    {
        $this->table = $table;
        $this->language = $language;
    }

    /**
     * Adds a CSV file as a field seeder.
     *
     * @param string $field The name of the field to seed.
     * @param string $csvFile The path to the CSV file.
     * @param string $target_csv_column The column to target from the CSV file.
     *
     * @return FieldSeeder The field seeder object.
     * @throws Exception If there is a error.
     */
    public function csv(string $field, string $csvFile, string $target_csv_column): FieldSeeder
    {
        return $this->addField($field, new CsvSeeder($this, $field, $csvFile, $target_csv_column));
    }

    /**
     * Adds a random string field seeder.
     *
     * @param string $field The name of the field.
     * @param int|null $stringSize Optional size for the string.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function randomString(string $field, int $stringSize = null) : FieldSeeder
    {
        return $this->addField($field, new RandomStringSeeder($this, $field, $stringSize));
    }

    /**
     * Adds a file field seeder.
     *
     * @param string $field The name of the field.
     * @param string $source The source path or identifier.
     * @param string $destination The destination path or identifier.
     * @param Closure|null $callback Optional callback to manipulate the file.
     * @param Closure|null $renameCallback Optional callback to rename the file.
     * @param string|null $memoryLimit Optional memory limit for the seeding process.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function file(
        string $field,
        string $source,
        string $destination,
        ?Closure $callback = null,
        ?Closure $renameCallback = null,
        ?string $memoryLimit = null
    ): FieldSeeder {
        return $this->addField($field, new FileSeeder(
            $this,
            $field,
            $source,
            $destination,
            $callback,
            $renameCallback,
            $memoryLimit
        ));
    }


    /**
     * Adds a name field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function name(string $field): FieldSeeder
    {
        return $this->addField($field, new FullNameSeeder($this, $field));
    }

    /**
     * Adds an email field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function email(string $field): FieldSeeder
    {
        return $this->addField($field, new EmailSeeder($this, $field));
    }

    /**
     * Adds a city field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function city(string $field): FieldSeeder
    {
        return $this->addField($field, new CitySeeder($this, $field));
    }

    /**
     * Adds a country field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function country(string $field): FieldSeeder
    {
        return $this->addField($field, new CountrySeeder($this, $field));
    }

    public function text(string $field, int $maxCharacters): FieldSeeder
    {
        return $this->addField($field, new TextSeeder($this, $field, $maxCharacters));
    }

    /**
     * Adds a firstname field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function firstname(string $field, ?string $gender): FieldSeeder
    {
        return $this->addField($field, new FirstNameSeeder($this, $field, $gender));
    }

    /**
     * Adds a lastname field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function lastname(string $field, ?string $gender): FieldSeeder
    {
        return $this->addField($field, new LastNameSeeder($this, $field, $gender));
    }

    /**
     * Adds a password field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function password(string $field, ?int $minLength, ?int $maxLength): FieldSeeder
    {
        return $this->addField($field, new PasswordSeeder($this, $field, $minLength, $maxLength));
    }

    /**
     * Adds a phone number field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function phoneNumber(string $field): FieldSeeder
    {
        return $this->addField($field, new PhoneNumberSeeder($this, $field));
    }

    /**
     * Adds a username field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function username(string $field): FieldSeeder
    {
        return $this->addField($field, new UsernameSeeder($this, $field));
    }

    /**
     * Adds a weight values field seeder.
     *
     * @param string $field The name of the field.
     * @param array $weights The array of weight values.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function weightValues(string $field, array $weights): FieldSeeder
    {
        return $this->addField($field, new WeightValuesSeeder($this, $field, $weights));
    }

    /**
     * Adds a company field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function company(string $field): FieldSeeder
    {
        return $this->addField($field, new CompanySeeder($this, $field));
    }

    /**
     * Adds a currency code field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function currencyCode(string $field): FieldSeeder
    {
        return $this->addField($field, new CurrencyCodeSeeder($this, $field));
    }

    /**
     * Adds a address field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function address(string $field): FieldSeeder {
        return $this->addField($field, new AddressSeeder($this, $field));
    }

    /**
     * Adds a building number field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function buildingNumber(string $field): FieldSeeder {
        return $this->addField($field, new BuildingNumber($this, $field));
    }

    /**
     * Adds a latitude field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function latitude(string $field): FieldSeeder {
        return $this->addField($field, new LatitudeSeeder($this, $field));
    }

    /**
     * Adds a longitude field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function longitude(string $field): FieldSeeder {
        return $this->addField($field, new LongitudeSeeder($this, $field));
    }

    /**
     * Adds a postcode field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function postcode(string $field): FieldSeeder {
        return $this->addField($field, new PostcodeSeeder($this, $field));
    }

    /**
     * Adds a street address field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function streetAddress(string $field): FieldSeeder {
        return $this->addField($field, new StreetAddressSeeder($this, $field));
    }

    /**
     * Adds a street name field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function streetName(string $field): FieldSeeder
    {
        return $this->addField($field, new StreetNameSeeder($this, $field));
    }

    /**
     * Adds a street suffix field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function streetSuffix(string $field): FieldSeeder
    {
        return $this->addField($field, new StreetSuffixSeeder($this, $field));
    }

    /**
     * Adds a domain name field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function domainName(string $field): FieldSeeder
    {
        return $this->addField($field, new DomainNameSeeder($this, $field));
    }

    /**
     * Adds a ipv4 field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function ipv4(string $field): FieldSeeder
    {
        return $this->addField($field, new IPv4Seeder($this, $field));
    }

    /**
     * Adds a ipv6 field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function ipv6(string $field): FieldSeeder
    {
        return $this->addField($field, new IPv6Seeder($this, $field));
    }

    /**
     * Adds a local ipv4 field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function localIpv4(string $field): FieldSeeder
    {
        return $this->addField($field, new LocalIpv4Seeder($this, $field));
    }

    /**
     * Adds a mac address field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function macAddress(string $field): FieldSeeder
    {
        return $this->addField($field, new MacAddressSeeder($this, $field));
    }

    /**
     * Adds a url field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function url(string $field): FieldSeeder {
        return $this->addField($field, new UrlSeeder($this, $field));
    }

    /**
     * Adds a boolean field seeder.
     *
     * @param string $field The name of the field.
     * @param int|null $chanceOfGettingTrue The chance (percentage) of the value being true.
     *                                      If null, the chance is considered 50/50.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function boolean(string $field, ?int $chanceOfGettingTrue): FieldSeeder
    {
        return $this->addField($field, new BooleanSeeder($this, $field, $chanceOfGettingTrue));
    }

    /**
     * Adds a emoji field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function emoji(string $field): FieldSeeder
    {
        return $this->addField($field, new EmojiSeeder($this, $field));
    }

    /**
     * Adds a language code field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function languageCode(string $field): FieldSeeder
    {
        return $this->addField($field, new LanguageCodeSeeder($this, $field));
    }

    /**
     * Adds a md5 field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function md5(string $field): FieldSeeder
    {
        return $this->addField($field, new Md5Seeder($this, $field));
    }

    /**
     * Adds a sha1 field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function sha1(string $field): FieldSeeder
    {
        return $this->addField($field, new Sha1Seeder($this, $field));
    }

    /**
     * Adds a sha256 field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function sha256(string $field): FieldSeeder
    {
        return $this->addField($field, new Sha256Seeder($this, $field));
    }

    /**
     * Adds a digit not null field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function digitNotNull(string $field): FieldSeeder
    {
        return $this->addField($field, new DigitNotNullSeeder($this, $field));
    }

    /**
     * Adds a digit not equal to a specific value field seeder.
     *
     * @param string $field The name of the field.
     * @param int $value The digit value that the field should not contain.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function digitNot(string $field, int $value): FieldSeeder
    {
        return $this->addField($field, new DigitNotSeeder($this, $field, $value));
    }

    /**
     * Adds a digit field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function digit(string $field): FieldSeeder
    {
        return $this->addField($field, new DigitSeeder($this, $field));
    }

    /**
     * Adds a float field seeder with optional decimal precision and range.
     *
     * @param string $field The name of the field.
     * @param int|null $nbMaxDecimals The maximum number of decimal places for the float value, or null for no restriction.
     * @param int|null $min The minimum value for the float, or null for no minimum.
     * @param int|null $max The maximum value for the float, or null for no maximum.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function float(string $field, ?int $nbMaxDecimals, ?int $min, ?int $max): FieldSeeder
    {
        return $this->addField($field, new FloatSeeder($this, $field, $nbMaxDecimals, $min, $max));
    }

    /**
     * Adds a number between a specified minimum and maximum value.
     *
     * @param string $field The name of the field.
     * @param int|null $min The minimum value for the number, or null for no minimum.
     * @param int|null $max The maximum value for the number, or null for no maximum.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function numberBetween(string $field, ?int $min, ?int $max): FieldSeeder
    {
        return $this->addField($field, new NumberBetweenSeeder($this, $field, $min, $max));
    }

    /**
     * Adds a number field seeder with optional digit length and strict validation.
     *
     * @param string $field The name of the field.
     * @param int|null $nbDigits The number of digits for the generated number, or null for no restriction.
     * @param bool|null $strict If true, enforces strict digit count; if false or null, allows flexibility.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function number(string $field, ?int $nbDigits, ?bool $strict): FieldSeeder
    {
        return $this->addField($field, new NumberSeeder($this, $field, $nbDigits, $strict));
    }

    /**
     * Adds a credit card field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function creditCardDetails(string $field): FieldSeeder
    {
        return $this->addField($field, new CreditCardDetailsSeeder($this, $field));
    }

    /**
     * Adds a credit card expiration date field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function creditCardExpirationDate(string $field): FieldSeeder
    {
        return $this->addField($field, new CreditCardExpirationDateSeeder($this, $field));
    }

    /**
     * Adds a credit card number field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function creditCardNumber(string $field): FieldSeeder
    {
        return $this->addField($field, new CreditCardNumberSeeder($this, $field));
    }

    /**
     * Adds a credit card type field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function creditCardType(string $field): FieldSeeder
    {
        return $this->addField($field, new CreditCardTypeSeeder($this, $field));
    }

    /**
     * Adds an IBAN field seeder with optional country code, prefix, and length customization.
     *
     * @param string $field The name of the field.
     * @param string|null $countryCode The country code for the IBAN, or null for default behavior.
     * @param string|null $prefix The prefix for the IBAN, or null for no prefix.
     * @param int|null $length The length of the IBAN, or null for default length.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function iban(string $field, ?string $countryCode, ?string $prefix, ?int $length): FieldSeeder
    {
        return $this->addField($field, new IbanSeeder($this, $field, $countryCode, $prefix, $length));
    }


    /**
     * Adds a swift bic field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function swiftBic(string $field): FieldSeeder
    {
        return $this->addField($field, new SwiftBicNumberSeeder($this, $field));
    }

    /**
     * Adds a date field seeder with optional format, start date, and end date customization.
     *
     * @param string $field The name of the field.
     * @param string|null $format The format of the date, or null for the default format.
     * @param string|null $startDate The start date for the range, or null for no start date.
     * @param string|null $endDate The end date for the range, or null for no end date.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function date(string $field, ?string $format, ?string $startDate, ?string $endDate): FieldSeeder
    {
        return $this->addField($field, new DateSeeder($this, $field, $format, $startDate, $endDate));
    }

    /**
     * Adds a timezone field seeder.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function timezone(string $field): FieldSeeder
    {
        return $this->addField($field, new TimezoneSeeder($this, $field));
    }

    /**
     * Adds a field seeder for bothify pattern (alphanumeric replacement).
     *
     * @param string $field The name of the field.
     * @param string $pattern The pattern to bothify.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function bothify(string $field, string $pattern): FieldSeeder
    {
        return $this->addField($field, new BothifySeeder($this, $field, $pattern));
    }

    /**
     * Adds a field seeder for a single letter.
     *
     * @param string $field The name of the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function letter(string $field): FieldSeeder
    {
        return $this->addField($field, new LetterSeeder($this, $field));
    }

    /**
     * Adds a field seeder for lexify pattern (alphabetic replacement).
     *
     * @param string $field The name of the field.
     * @param string $pattern The pattern to lexify.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function lexify(string $field, string $pattern): FieldSeeder
    {
        return $this->addField($field, new LexifySeeder($this, $field, $pattern));
    }

    /**
     * Adds a field seeder with a fixed value, which can be a string, callable, or null.
     *
     * @param string $field The name of the field.
     * @param mixed $value The value to set for the field.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function value(string $field, mixed $value): FieldSeeder
    {
        return $this->addField($field, new ValueSeeder($this, $field, $value));
    }

    /**
     * Adds a field seeder with an array of values.
     *
     * @param string $field The name of the field.
     * @param array $value The array of values for the field.
     * @param bool $useOrderedValues Whether to use ordered values or not (default: false).
     *
     * @return FieldSeeder The field seeder object.
     */
    public function array(string $field, array $value, bool $useOrderedValues = false): FieldSeeder
    {
        return $this->addField($field, new ArraySeeder($this, $field, $value, $useOrderedValues));
    }

    /**
     * Adds a field seeder for sequential numbers starting from a given value.
     *
     * @param string $field The name of the field.
     * @param int $start The starting number for the sequence.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function sequential(string $field, int $start): FieldSeeder
    {
        return $this->addField($field, new SequentionalNumberSeeder($this, $field, $start));
    }

    public function timeSeries(
        string $field,
        string $startDate,
        string $endDate,
        string $granularity,
        Closure $entriesPerPeriod,
        Closure $entryFactory,
        Closure $deltaAvg,
    ): FieldSeeder
    {
        return $this->addField($field, new TimeSeriesSeeder(
            $this,
            $field,
            $startDate,
            $endDate,
            $granularity,
            $entriesPerPeriod,
            $entryFactory,
            $deltaAvg
        ));
    }


    /**
     * Adds a field seeder that fetches values from a SQL query.
     *
     * @param string $field The name of the field.
     * @param string $query The SQL query to execute.
     * @param array $bindings The bindings for the SQL query.
     *
     * @return FieldSeeder The field seeder object.
     */
    public function sql(string $field, string $query, array $bindings, bool $preserveOrder = false): FieldSeeder
    {
        return $this->addField($field, new SqlSeeder($this, $field, $query, $bindings, $preserveOrder));
    }

    /**
     * Adds a field seeder to the fields array.
     *
     * @param string $field The name of the field.
     * @param FieldSeeder $seeder The field seeder instance to add.
     *
     * @return FieldSeeder The field seeder object.
     */
    private function addField(string $field, FieldSeeder $seeder): FieldSeeder
    {
        $this->fields[$field] = $seeder;
        return $this->fields[$field];
    }

    /**
     * Retrieves all the field seeders.
     *
     * @return array The array of field seeders.
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * Retrieves the table name.
     *
     * @return string The table name.
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * Retrieves the language setting.
     *
     * @return string The language setting.
     */
    public function getLanguage(): string
    {
        return $this->language;
    }
}
