<?php

namespace IPLeiria\ESTG\EI\DBContextSeeder\Seeders\Miscellaneous;

use Illuminate\Support\Facades\DB;
use IPLeiria\ESTG\EI\DBContextSeeder\FieldSeeder;

class SqlSeeder extends FieldSeeder
{
    protected string $query;
    protected array $bindings;

    public function __construct($tableSeeder, $field, string $query, array $bindings = [])
    {
        parent::__construct($tableSeeder, $field);
        $this->query = $query;
        $this->bindings = $bindings;
    }

    protected function generateValue(): mixed
    {
        $result = DB::select($this->query, $this->bindings);

        if (empty($result)) {
            return null;
        }

        return reset($result[0]);
    }
}
