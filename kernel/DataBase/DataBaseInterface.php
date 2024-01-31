<?php

namespace App\Kernel\DataBase;

interface DataBaseInterface
{
    public function insert(string $table, array $data): int|false;

    public function first(string $table, array $conditions = []): ?array;

}