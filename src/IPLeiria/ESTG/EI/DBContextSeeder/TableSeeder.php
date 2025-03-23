<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder;

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
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous\BooleanSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous\EmojiSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous\LanguageCodeSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous\Md5Seeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous\Sha1Seeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous\Sha256Seeder;
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

require_once 'Seeders/Seeders.php';

class TableSeeder
{
    protected string $table;
    protected array $fields = [];
    protected string $language;

    public function __construct(string $table, string $language)
    {
        $this->table = $table;
        $this->language = $language;
    }

    public function name(string $field): FieldSeeder
    {
        return $this->addField($field, new FullNameSeeder($this, $field, $this->language));
    }

    public function email(string $field): FieldSeeder
    {
        return $this->addField($field, new EmailSeeder($this, $field, $this->language));
    }

    public function city(string $field): FieldSeeder
    {
        return $this->addField($field, new CitySeeder($this, $field, $this->language));
    }

    public function country(string $field): FieldSeeder
    {
        return $this->addField($field, new StreetAddressSeeder($this, $field, $this->language));
    }

    public function firstname(string $field, ?string $gender): FieldSeeder
    {
        return $this->addField($field, new FirstNameSeeder($this, $field, $this->language, $gender));
    }

    public function lastname(string $field, ?string $gender): FieldSeeder
    {
        return $this->addField($field, new LastNameSeeder($this, $field, $this->language, $gender));
    }

    public function password(string $field, ?int $minLength, ?int $maxLength): FieldSeeder
    {
        return $this->addField($field, new PasswordSeeder($this, $field, $this->language, $minLength, $maxLength));
    }

    public function phoneNumber(string $field): FieldSeeder
    {
        return $this->addField($field, new PhoneNumberSeeder($this, $field, $this->language));
    }

    public function username(string $field): FieldSeeder
    {
        return $this->addField($field, new UsernameSeeder($this, $field, $this->language));
    }

    public function weightValues(string $field, array $weights): FieldSeeder
    {
        return $this->addField($field, new WeightValuesSeeder($this, $field, $weights));
    }

    public function company(string $field): FieldSeeder
    {
        return $this->addField($field, new CompanySeeder($this, $field, $this->language));
    }

    public function currencyCode(string $field): FieldSeeder
    {
        return $this->addField($field, new CurrencyCodeSeeder($this, $field, $this->language));
    }

    public function address(string $field): FieldSeeder {
        return $this->addField($field, new AddressSeeder($this, $field, $this->language));
    }

    public function buildingNumber(string $field): FieldSeeder {
        return $this->addField($field, new BuildingNumber($this, $field, $this->language));
    }

    public function latitude(string $field): FieldSeeder {
        return $this->addField($field, new LatitudeSeeder($this, $field, $this->language));
    }

    public function longitude(string $field): FieldSeeder {
        return $this->addField($field, new LongitudeSeeder($this, $field, $this->language));
    }

    public function postcode(string $field): FieldSeeder {
        return $this->addField($field, new PostcodeSeeder($this, $field, $this->language));
    }

    public function streetAddress(string $field): FieldSeeder {
        return $this->addField($field, new StreetAddressSeeder($this, $field, $this->language));
    }

    public function streetName(string $field): FieldSeeder
    {
        return $this->addField($field, new StreetNameSeeder($this, $field, $this->language));
    }

    public function streetSuffix(string $field): FieldSeeder
    {
        return $this->addField($field, new StreetSuffixSeeder($this, $field, $this->language));
    }

    public function domainName(string $field): FieldSeeder
    {
        return $this->addField($field, new DomainNameSeeder($this, $field, $this->language));
    }

    public function ipv4(string $field): FieldSeeder
    {
        return $this->addField($field, new IPv4Seeder($this, $field, $this->language));
    }

    public function ipv6(string $field): FieldSeeder
    {
        return $this->addField($field, new IPv6Seeder($this, $field, $this->language));
    }

    public function localIpv4(string $field): FieldSeeder
    {
        return $this->addField($field, new LocalIpv4Seeder($this, $field, $this->language));
    }

    public function macAddress(string $field): FieldSeeder
    {
        return $this->addField($field, new MacAddressSeeder($this, $field, $this->language));
    }

    public function url(string $field): FieldSeeder {
        return $this->addField($field, new UrlSeeder($this, $field, $this->language));
    }

    public function boolean(string $field): FieldSeeder
    {
        return $this->addField($field, new BooleanSeeder($this, $field, $this->language));
    }

    public function emoji(string $field): FieldSeeder
    {
        return $this->addField($field, new EmojiSeeder($this, $field, $this->language));
    }

    public function languageCode(string $field): FieldSeeder
    {
        return $this->addField($field, new LanguageCodeSeeder($this, $field, $this->language));
    }

    public function md5(string $field): FieldSeeder
    {
        return $this->addField($field, new Md5Seeder($this, $field, $this->language));
    }

    public function sha1(string $field): FieldSeeder
    {
        return $this->addField($field, new Sha1Seeder($this, $field, $this->language));
    }

    public function sha256(string $field): FieldSeeder
    {
        return $this->addField($field, new Sha256Seeder($this, $field, $this->language));
    }

    public function digitNotNull(string $field): FieldSeeder
    {
        return $this->addField($field, new DigitNotNullSeeder($this, $field, $this->language));
    }

    public function digitNot(string $field, int $value): FieldSeeder
    {
        return $this->addField($field, new DigitNotSeeder($this, $field, $value));
    }

    public function digit(string $field): FieldSeeder
    {
        return $this->addField($field, new DigitSeeder($this, $field));
    }

    public function float(string $field, ?int $nbMaxDecimals, ?int $min, ?int $max): FieldSeeder
    {
        return $this->addField($field, new FloatSeeder($this, $field, $nbMaxDecimals, $min, $max));
    }

    public function numberBetween(string $field, ?int $min, ?int $max): FieldSeeder
    {
        return $this->addField($field, new NumberBetweenSeeder($this, $field, $min, $max));
    }

    public function number(string $field, ?int $nbDigits, ?bool $strict): FieldSeeder
    {
        return $this->addField($field, new NumberSeeder($this, $field, $nbDigits, $strict));
    }

    public function creditCardDetails(string $field): FieldSeeder
    {
        return $this->addField($field, new CreditCardDetailsSeeder($this, $field));
    }

    public function creditCardExpirationDate(string $field): FieldSeeder
    {
        return $this->addField($field, new CreditCardExpirationDateSeeder($this, $field));
    }

    public function creditCardNumber(string $field): FieldSeeder
    {
        return $this->addField($field, new CreditCardNumberSeeder($this, $field, $this->language));
    }

    public function creditCardType(string $field): FieldSeeder
    {
        return $this->addField($field, new CreditCardTypeSeeder($this, $field, $this->language));
    }

    public function iban(string $field, ?string $countryCode, ?string $prefix, ?int $length): FieldSeeder
    {
        return $this->addField($field, new IbanSeeder($this, $field, $countryCode, $prefix, $length));
    }

    public function swiftBic(string $field): FieldSeeder
    {
        return $this->addField($field, new SwiftBicNumberSeeder($this, $field));
    }

    public function date(string $field, ?string $format, ?string $startDate, ?string $endDate): FieldSeeder
    {
        return $this->addField($field, new DateSeeder($this, $field, $format, $startDate, $endDate));
    }

    public function timezone(string $field): FieldSeeder
    {
        return $this->addField($field, new TimezoneSeeder($this, $field));
    }

    public function bothify(string $field, string $pattern): FieldSeeder
    {
        return $this->addField($field, new BothifySeeder($this, $field, $pattern));
    }

    public function letter(string $field): FieldSeeder
    {
        return $this->addField($field, new LetterSeeder($this, $field, $this->language));
    }

    public function lexify(string $field, string $pattern): FieldSeeder
    {
        return $this->addField($field, new LexifySeeder($this, $field, $pattern));
    }

    public function value(string $field, mixed $value): FieldSeeder
    {
        return $this->addField($field, new ValueSeeder($this, $field, $value));
    }

    private function addField(string $field, FieldSeeder $seeder): FieldSeeder
    {
        $this->fields[$field] = $seeder;
        return $this->fields[$field];
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function getTable(): string
    {
        return $this->table;
    }
}
