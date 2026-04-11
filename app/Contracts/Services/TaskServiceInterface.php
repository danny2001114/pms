<?php

namespace App\Contracts\Services;

use App\Http\Requests\Task\TaskRequest;
use App\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;

interface TaskServiceInterface
{
    public function getByProject(int $id): LengthAwarePaginator;
    public function store(int $projectId, TaskRequest $request): void;
    public function show(int $id): Task;
    public function update(int $id, TaskRequest $request): void;
    public function delete($id): void;
}
