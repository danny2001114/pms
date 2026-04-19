<?php

namespace App\Http\Controllers;

use App\Contracts\Services\TaskServiceInterface;
use App\Http\Requests\Task\TaskRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TaskController extends Controller
{
    public function __construct(
        protected TaskServiceInterface $taskService
    ) {}

    public function index() {}

    public function create(int $projectId): Response
    {
        return Inertia::render(page('Task.Create'), [
            "projectId" => $projectId,
            ...$this->appendOptions()
        ]);
    }

    public function store(int $projectId, TaskRequest $request): RedirectResponse
    {
        $this->taskService->store($projectId, $request);
        return redirect()->route('project.show', $projectId);
    }

    public function edit(int $projectId, int $id): Response
    {
        return Inertia::render(page('Task.Edit'), [
            "projectId" => $projectId,
            "task"      => $this->taskService->show($id),
            ...$this->appendOptions()
        ]);
    }

    public function update(int $projectId, int $id, TaskRequest $request): RedirectResponse
    {
        $this->taskService->update($id, $request);
        return redirect()->route('project.show', $projectId);
    }

    public function destroy(int $projectId, int $id): RedirectResponse
    {
        $this->taskService->delete($id);
        return redirect()->route('project.show', $projectId);
    }

    public function show(int $id): Response
    {
        return Inertia::render(page('Task.Detail'), []);
    }

    public function change(int $id, Request $request): RedirectResponse
    {
        return redirect()->route('task.index');
    }

    protected function appendOptions(): array
    {
        return [
            "stateOptions"    => config('constants.TASK.STATES.TEXT'),
            "priorityOptions" => config('constants.TASK.PRIORITIES.TEXT')
        ];
    }
}
