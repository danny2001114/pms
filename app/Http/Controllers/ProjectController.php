<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ProjectServiceInterface;
use App\Contracts\Services\ProjectTypeServiceInterface;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(
        protected ProjectServiceInterface $projectService,
        protected ProjectTypeServiceInterface $projectTypeService
    )
    {}

    public function index(Request $request)
    {
        return Inertia::render("Project/Index", [
            "projectLists" => $this->projectService->getList()
        ]);
    }

    public function create()
    {
        return Inertia::render("Project/Create", [
            "project_type_options" => $this->projectTypeService->getList(),
            ...$this->appendOptions()
        ]);
    }

    public function store(ProjectRequest $request)
    {
        $this->projectService->store($request);
        return redirect()->route('project.index');
    }

    public function show(int $id)
    {
        return Inertia::render("Project/Detail", [
            "project" => $this->projectService->getDetail($id)
        ]);
    }

    public function edit(int $id)
    {
        return Inertia::render("Project/Edit", [
            "project" => $this->projectService->getDetail($id),
            ...$this->appendOptions()
        ]);
    }

    public function update(int $id, ProjectRequest $request)
    {
        $this->projectService->update($request, $id);
        return redirect()->route('project.show', $id);
    }

    public function destroy(int $id)
    {
        $this->projectService->delete($id);
        return redirect()->route('project.index');
    }

    protected function appendOptions(): array
    {
        $projectTypes = $this->projectTypeService->getList()->reduce(function ($stack , $type) {
            $stack[$type->id] = $type->label;
            return $stack;
        }, []);

        return [
            "project_type_options" => $projectTypes,
            "state_options" => config('constants.PROJECT.STATES.TEXT'),
            "priority_options" => config('constants.PROJECT.PRIORITIES.TEXT')
        ];
    }
}
