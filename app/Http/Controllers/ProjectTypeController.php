<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ProjectTypeServiceInterface;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectType\ProjectTypeRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ProjectTypeController extends Controller
{
    public function __construct(
        protected ProjectTypeServiceInterface $projectTypeService
    )
    {}

    public function index(Request $request): Response
    {
        $validatedRequest = $request->validate([
            "label" => "nullable|string|max:255"
        ]);

        return Inertia::render(page("ProjectType.Manage"), [
            "projectTypeList" => $this->projectTypeService
                                      ->getList($validatedRequest),
            "total"           => $this->projectTypeService
                                      ->count($validatedRequest)
        ]);
    }

    public function store(ProjectTypeRequest $request): RedirectResponse
    {
        $this->projectTypeService->store($request);
        return redirect()->route('project.type.index');
    }

    public function update(ProjectTypeRequest $request, string $id): RedirectResponse
    {
        $this->projectTypeService->update($request, (int) $id);
        return redirect()->route('project.type.index');
    }

    public function destroy(string $id): RedirectResponse
    {
        $this->projectTypeService->destroy((int) $id);
        return redirect()->route('project.type.index');
    }
}
