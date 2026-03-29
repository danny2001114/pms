<?php

namespace App\Contracts\Dao;

use App\Models\ProjectType;
use Illuminate\Database\Eloquent\Collection;

interface ProjectTypeDaoInterface
{
    public function getList(array $filter): Collection;
    public function store(array $dto): ProjectType;
    public function update(int $id, array $dto): ProjectType;
    public function delete(int $id): int;
    public function getTotalCount(array $filter): int;
}
