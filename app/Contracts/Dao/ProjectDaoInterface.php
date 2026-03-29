<?php

namespace App\Contracts\Dao;

use Illuminate\Database\Eloquent\Collection;

interface ProjectDaoInterface
{
    public function getList(?int $lastId): Collection;
    public function store(array $dto): void;
    public function update(int $id, array $dto): void;
    public function delete(int $id): void;
}
