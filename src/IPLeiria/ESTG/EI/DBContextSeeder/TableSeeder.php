<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder;

use Illuminate\Support\Facades\DB;

class TableSeeder
{
    protected $table;
    protected $fields = [];
    protected $language;

    public function __construct($table, $language = "en_US") {
        $this->table = $table;
        $this->language = $language;
    }

    public function field($field): FieldSeeder
    {
        $this->fields[$field] = new FieldSeeder($this, $field, $this->language);
        return $this->fields[$field];
    }

    public function clearTable(): void
    {
        DB::table($this->table)->truncate();
    }

    public function populate($count): void
    {
        $this->clearTable();

        for ($i = 0; $i < $count; $i++) {
            $data = [];

            foreach ($this->fields as $field => $fieldSeeder) {
                $data[$field] = $fieldSeeder->generate();
            }

            DB::table($this->table)->insert($data);
        }
    }
}
