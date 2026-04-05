<?php

namespace App\Contracts\Dao;

use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

interface ProjectDaoInterface
{
    public function getPending(): Collection;
    public function getProcessing(): Collection;
    public function getCompleted(): Collection;
    public function getDetail(int $id): Project;
    public function store(array $dto): Project;
    public function update(int $id, array $dto): void;
    public function delete(int $id): void;
    public function getCountByDate(Carbon $date): int;
}
