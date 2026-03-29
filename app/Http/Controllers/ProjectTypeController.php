<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ProjectTypeServiceInterface;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectTypeRequest;
use Inertia\Inertia;

class ProjectTypeController extends Controller
{
    public function __construct(
        protected ProjectTypeServiceInterface $projectTypeService
    )
    {}

    public function index(Request $request)
    {
        $validatedRequest = $request->validate([
            "label" => "nullable|string|max:255"
        ]);

        return Inertia::render("Project/Type/Manage", [
            "project_type_list" => $this->projectTypeService
                                        ->getList($validatedRequest),
            "total"             => $this->projectTypeService
                                        ->getTotalCount($validatedRequest)
        ]);
    }

    public function store(ProjectTypeRequest $request)
    {
        $this->projectTypeService->store($request);
        return redirect()->route('project.type.index');
    }

    public function update(ProjectTypeRequest $request, string $id)
    {
        $projectType = $this->projectTypeService->update($request, (int) $id);
        return redirect()->route('project.type.index');
    }

    public function destroy(string $id)
    {
        $this->projectTypeService->delete((int) $id);
        return redirect()->route('project.type.index');
    }
}
