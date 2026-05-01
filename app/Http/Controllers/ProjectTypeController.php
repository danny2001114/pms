<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ProjectTypeServiceInterface;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectType\ProjectTypeRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

/**
 * handles HTTP requests related to project type operations
 */
class ProjectTypeController extends Controller
{
    /**
     * project type contoller constructor
     * @param ProjectTypeServiceInterface $projectTypeService inject the project type service
     */
    public function __construct(
        protected ProjectTypeServiceInterface $projectTypeService
    ) {}

    /**
     * project type list page
     * @param Request $filter search filter request
     * @return \Inertia\Response
     */
    public function index(Request $filter): Response
    {
        $validatedfilter = $filter->validate([
            "label" => "nullable|string|max:255"
        ]);

        return Inertia::render(page("ProjectType.Index"), [
            "projectTypes" => $this->projectTypeService->getList($validatedfilter)
        ]);
    }

    /**
     * store project type and redirect to list page
     * @param ProjectTypeRequest $request validated project type request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProjectTypeRequest $request): RedirectResponse
    {
        $this->projectTypeService->store($request);
        return redirect()->route('project.type.index');
    }

    /**
     * update project type and redirect to list page
     * @param int $id project type id
     * @param ProjectTypeRequest $request validated project type request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(int $id, ProjectTypeRequest $request): RedirectResponse
    {
        $this->projectTypeService->update($id, $request);
        return redirect()->route('project.type.index');
    }

    /**
     * delete project type
     * @param string $id project type id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->projectTypeService->destroy((int) $id);
        return redirect()->route('project.type.index');
    }
}
