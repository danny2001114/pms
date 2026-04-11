<?php

namespace App\Contracts\Dao;

use App\Data\ProjectType\ProjectTypeData;
use App\Models\ProjectType;
use Illuminate\Database\Eloquent\Collection;

interface ProjectTypeDaoInterface
{
    public function getList(array $filter): Collection;
    public function store(ProjectTypeData $data): ProjectType;
    public function update(int $id, ProjectTypeData $data): ProjectType;
    public function destroy(int $id): int;
    public function count(array $filter): int;
}
