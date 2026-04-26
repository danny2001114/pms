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

/**
 * handles HTTP requests related to project operations
 */
class ProjectController extends Controller
{
    /**
     * project contoller constructor
     * @param ProjectServiceInterface $projectService inject the project service
     * @param ProjectTypeServiceInterface $projectTypeService inject the project type service
     * @param TaskServiceInterface $taskService inject the task service
     */
    public function __construct(
        protected ProjectServiceInterface $projectService,
        protected ProjectTypeServiceInterface $projectTypeService,
        protected TaskServiceInterface $taskService
    ) {}

    /**
     * project list page
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request): Response
    {
        return Inertia::render(page("Project.Index"), [
            "projects" => $this->projectService->getList()
        ]);
    }

    /**
     * project create page
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render(page("Project.Create"), $this->appendOptions());
    }

    /**
     * store project and redirect to detail page if success
     * @param ProjectRequest $request validated project request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProjectRequest $request): RedirectResponse
    {
        $project = $this->projectService->store($request);

        if ($project) {
            return redirect()->route('project.show', $project->id);
        } else {
            return redirect()->route('project.create');
        }
    }

    /**
     * project detail page
     * @param int $id project id
     * @return \Inertia\Response
     */
    public function show(int $id): Response
    {
        return Inertia::render(page("Project.Detail"), [
            "project" => $this->projectService->getDetail($id),
            ...$this->appendOptions()
        ]);
    }

    /**
     * project edit page
     * @param int $id project id
     * @return \Inertia\Response
     */
    public function edit(int $id): Response
    {
        return Inertia::render(page("Project.Edit"), [
            "project" => $this->projectService->getDetail($id),
            ...$this->appendOptions()
        ]);
    }

    /**
     * update project and redirect to  previous page
     * @param int $id
     * @param ProjectRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(int $id, ProjectRequest $request): RedirectResponse
    {
        $this->projectService->update($id, $request);
        return redirect()->back();
    }

    /**
     * delete project
     * @param int $id project id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->projectService->delete($id);
        return redirect()->route('project.index');
    }

    /**
     * append form options to project form pages
     * @return array{projectTypes: array, priorities: array, states: array}
     */
    protected function appendOptions(): array
    {
        $projectTypes = $this->projectTypeService->getList()->map(function ($type) {
            return [
                "value" => $type->id,
                "text" => $type->label 
            ];
        });

        return [
            "projectTypes" => $projectTypes,
            "states"       => config('constants.PROJECT.STATES.OPTIONS'),
            "priorities"    => config('constants.PROJECT.PRIORITIES.OPTIONS')
        ];
    }
}
