<?php

namespace App\Dao;

use App\Contracts\Dao\TaskDaoInterface;
use App\Data\Task\CreateTaskData;
use App\Data\Task\UpdateTaskData;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskDao implements TaskDaoInterface
{
    public function __construct(
        protected Task $task
    ) {}

    public function getByProject(int $id): LengthAwarePaginator
    {
        return $this->task::where('project_id', $id)
            ->paginate();
    }

    public function store(CreateTaskData $data): void
    {
        $this->task::create($data->toArray());
    }

    public function show(int $id): Task
    {
        return $this->task::findOrFail($id);
    }

    public function update(int $id, UpdateTaskData $data): void
    {
        $this->task::findOrFail($id)
            ->update($data->toArray());
    }

    public function delete($id): void
    {
        $this->task::findOrFail($id)
            ->delete();
    }

    public function countByDate(Carbon $date): int
    {
        return $this->task::whereDate('start_date', $date)
            ->count();
    }
}
