<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ProjectServiceInterface;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(
        protected ProjectServiceInterface $projectService
    )
    {}

    public function index(Request $request)
    {
        $validatedId = $request->validate([
            "last_id" => "nullable|integer|exists:projects,id" 
        ]);

        return Inertia::render("Project/Index", [
            "projects" => $this->projectService->getList($validatedId["last_id"] ?? null)
        ]);
    }

    public function create()
    {
        return Inertia::render("Project/Create");
    }

    public function store(ProjectRequest $request)
    {
        $this->projectService->store($request);
        return action('index');
    }

    public function show(Project $project)
    {
        return Inertia::render("Project/Detail", [
            "project" => $project
        ]);
    }

    public function edit(Project $project)
    {
        return Inertia::render("Project/Edit",[
            "project" => $project
        ]);
    }

    public function update(ProjectRequest $request, int $id)
    {
        $this->projectService->update($request, $id);
        return action('index');
    }

    public function destroy(int $id)
    {
        $this->projectService->delete($id);
        return action('index');
    }
}
