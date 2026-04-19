<?php

namespace App\Services;

use App\Contracts\Dao\TaskDaoInterface;
use App\Contracts\Services\TaskServiceInterface;
use App\Data\Task\CreateTaskData;
use App\Data\Task\UpdateTaskData;
use App\Http\Requests\Task\TaskRequest;
use App\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class TaskService implements TaskServiceInterface
{
    protected $createTaskData = CreateTaskData::class;
    protected $updateTaskData = UpdateTaskData::class;
    public function __construct(
        protected TaskDaoInterface $taskDao
    ) {}

    public function getByProject(int $id): LengthAwarePaginator
    {
        return $this->taskDao->getByProject($id);
    }

    public function store(int $projectId, TaskRequest $request): void
    {
        $data = $request->validated();
        $data['code']       = $this->generateCode($data["start_date"]);
        $data['project_id'] = $projectId;
        $this->taskDao->store(
            $this->createTaskData::from($data)
        );
    }

    public function show(int $id): Task
    {
        return $this->taskDao->show($id);
    }

    public function update(int $id, TaskRequest $request): void
    {
        $this->taskDao->update(
            $id,
            $this->updateTaskData::from($request->validated())
        );
    }

    public function delete($id): void
    {
        $this->taskDao->delete($id);
    }

    protected function generateCode(string $date): string
    {
        $date = Carbon::parse($date);
        $total = $this->taskDao->countByDate($date);
        return 'T' . $date->format("Ymd") . sprintf("%05d", $total + 1);
    }
}
