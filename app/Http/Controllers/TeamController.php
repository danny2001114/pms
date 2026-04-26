<?php

namespace App\Http\Controllers;

use App\Contracts\Services\TeamServiceInterface;
use App\Http\Requests\Team\TeamRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

/**
 * handles HTTP requests related to team operations
 */
class TeamController extends Controller
{
    /**
     * team controller constructor
     * @param TeamServiceInterface $teamService inject team service
     */
    public function __construct(
        public TeamServiceInterface $teamService
    ) {}

    /**
     * team list page
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request): Response
    {
        return Inertia::render(page('Team.Index'), [
            "teams" => $this->teamService->getList()
        ]);
    }

    /**
     * team create page
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render(page('Team.Create'));
    }

    /**
     * store team and redirect to detail page if success
     * @param TeamRequest $request validated team request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TeamRequest $request): RedirectResponse
    {
        $team = $this->teamService->store($request);

        if ($team) {
            return redirect()->route('team.show', $team->id);
        } else {
            return redirect()->route('user.create');
        }
    }

    /**
     * team detail page
     * @param int $id team id
     * @return \Inertia\Response
     */
    public function show(int $id): Response
    {
        return Inertia::render(page('Team.Detail'), [
            "team" => $this->teamService->getDetail($id)
        ]);
    }

    /**
     * team edit page
     * @param int $id team id
     * @return \Inertia\Response
     */
    public function edit(int $id): Response
    {
        return Inertia::render(page('Team.Edit'), [
            "team" => $this->teamService->getDetail($id),
        ]);
    }

    /**
     * update team and redirect to  previous page
     * @param int $id team id
     * @param TeamRequest $request validated team request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(int $id, TeamRequest $request): RedirectResponse
    {
        $this->teamService->update($id, $request);
        return redirect()->back();
    }

    /**
     * delete team
     * @param int $id team id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->teamService->delete($id);
        return redirect()->route('team.index');
    }
}
