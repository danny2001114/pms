<?php

namespace App\Contracts\Dao;

use App\Data\Task\CreateTaskData;
use App\Data\Task\UpdateTaskData;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

interface TaskDaoInterface
{
    public function getByProject(int $id): LengthAwarePaginator;
    public function store(CreateTaskData $data): void;
    public function show(int $id): Task;
    public function update(int $id, UpdateTaskData $data): void;
    public function delete($id): void;
    public function countByDate(Carbon $date): int;
}
