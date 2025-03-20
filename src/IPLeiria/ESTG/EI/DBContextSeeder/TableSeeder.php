<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder;

use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography\CitySeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Geography\CountrySeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous\WeightValuesSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal\EmailSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal\FirstNameSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal\FullNameSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal\LastNameSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal\PasswordSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal\PhoneNumberSeeder;
use IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Personal\UsernameSeeder;

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
        return $this->addField($field, new CountrySeeder($this, $field, $this->language));
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
