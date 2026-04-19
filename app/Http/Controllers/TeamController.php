<?php

namespace App\Http\Controllers;

use App\Contracts\Services\TeamServiceInterface;
use App\Http\Requests\Team\TeamRequest;
use App\Http\Resources\Team\TeamResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TeamController extends Controller
{
    public function __construct(
        public TeamServiceInterface $teamService
    ) {}

    public function index(Request $request): Response
    {
        return Inertia::render(page('Team.Index'), [
            "teamList" => $this->teamService->getList(),
            "total" => $this->teamService->count()
        ]);
    }

    public function create(): Response
    {
        return Inertia::render(page('Team.Create'));
    }

    public function store(TeamRequest $request): RedirectResponse
    {
        $team = $this->teamService->store($request);
        return redirect()->route('team.show', $team->id);
    }

    public function show(int $id): Response
    {
        return Inertia::render(page('Team.Detail'), [
            "team" => (new TeamResource($this->teamService->show($id)))->resolve(),
        ]);
    }

    public function edit(int $id): Response
    {
        return Inertia::render(page('Team.Edit'), [
            "team" => $this->teamService->show($id),
        ]);
    }

    public function update(int $id, TeamRequest $request): RedirectResponse
    {
        $this->teamService->update($id, $request);
        return redirect()->route('team.show', $id);
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->teamService->destroy($id);
        return redirect()->route('team.index');
    }
}
