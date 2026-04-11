<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ProjectServiceInterface;
use App\Contracts\Services\ProjectTypeServiceInterface;
use App\Contracts\Services\TaskServiceInterface;
use App\Http\Requests\Project\ProjectRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    public function __construct(
        protected ProjectServiceInterface $projectService,
        protected ProjectTypeServiceInterface $projectTypeService,
        protected TaskServiceInterface $taskService
    )
    {}

    public function index(Request $request): Response
    {
        return Inertia::render(page("Project.Index"), [
            "projectLists" => $this->projectService->getList()
        ]);
    }

    public function create(): Response
    {
        return Inertia::render(page("Project.Create"), $this->appendOptions());
    }

    public function store(ProjectRequest $request): RedirectResponse
    {
        $project = $this->projectService->store($request);
        if ($project?->id) {
            return redirect()->route('project.show', $project->id);
        } else {
            return redirect()->route('project.create')->withErrors([
                "error" => "",
            ]);
        }
    }

    public function show(int $id): Response
    {
        return Inertia::render(page("Project.Detail"), [
            "project" => $this->projectService->show($id),
            "tasks"   => $this->taskService->getByProject($id),
            ...$this->appendOptions()
        ]);
    }

    public function update(int $id, ProjectRequest $request): RedirectResponse
    {
        $this->projectService->update($request, $id);
        return redirect()->route('project.show', $id);
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->projectService->destroy($id);
        return redirect()->route('project.index');
    }

    protected function appendOptions(): array
    {
        $projectTypes = $this->projectTypeService->getList()->reduce(function ($stack , $type) {
            $stack[$type->id] = $type->label;
            return $stack;
        }, []);

        return [
            "projectTypeOptions" => $projectTypes,
            "stateOptions"       => config('constants.PROJECT.STATES.TEXT'),
            "priorityOptions"    => config('constants.PROJECT.PRIORITIES.TEXT')
        ];
    }
}
