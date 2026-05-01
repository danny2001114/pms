<?php

namespace App\Http\Controllers;

use App\Contracts\Services\TeamMemberServiceInterface;
use App\Http\Requests\TeamMember\TeamMemberRequest;
use Illuminate\Http\RedirectResponse;

class TeamMemberController extends Controller
{
    public function __construct(
        protected TeamMemberServiceInterface $teamMemberService
    ) {}

    /**
     * store team member and redirect to team page
     * @param int $teamId
     * @param TeamMemberRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(int $teamId, TeamMemberRequest $request): RedirectResponse
    {
        $this->teamMemberService->store($teamId, $request->code);
        return redirect()->route('team.show', $teamId);
    }

    /**
     * delete team member and redirect to team page
     * @param int $teamId team id
     * @param int $id member id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $teamId, int $id): RedirectResponse
    {
        $this->teamMemberService->delete($id);
        return redirect()->route('team.show', $teamId);
    }
}
