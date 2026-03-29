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
        $projectType = $this->projectTypeService->store($request);

        if ($projectType) {
            return response()->json(["project_type" => $projectType]);
        }
    }

    public function update(ProjectTypeRequest $request, string $id)
    {
        $projectType = $this->projectTypeService->update($request, (int) $id);

        return response()->json(["project_type" => $projectType]);
    }

    public function destroy(string $id)
    {
        $result = $this->projectTypeService->delete((int) $id);

        if ($result) {
            return response()->json(["id" => (int) $id]);
        }
    }

    public function fetch(Request $request)
    {
        $validatedRequest = $request->validate([
            "last_id" => "nullable|integer|exists:project_types,id",
            "label" => "nullable|string|max:255",
        ]);

        return response()->json([
            "incomings"  => $this->projectTypeService
                                ->getList($validatedRequest),
            "total"     => $this->projectTypeService
                                ->getTotalCount($validatedRequest)
        ]);
    }
}
