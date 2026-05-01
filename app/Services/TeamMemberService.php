<?php

namespace App\Services;

use App\Contracts\Dao\TeamMemberDaoInterface;
use App\Contracts\Services\TeamMemberServiceInterface;
use App\Data\TeamMember\TeamMemberData;
use Illuminate\Support\Facades\DB;

/**
 * handles business logic related to team member operations
 */
class TeamMemberService implements TeamMemberServiceInterface
{
    /**
     * data transfer object class used for creating team member data.
     * @var string
     */
    protected string $teamMemberData = TeamMemberData::class;

    /**
     * team member service constructor
     * @param TeamMemberDaoInterface $teamMemberDao inject the team member data access object
     * @param UserService $userService inject the user data access object
     */
    public function __construct(
        protected TeamMemberDaoInterface $teamMemberDao,
        protected UserService $userService
    ) {}

    public function store(int $teamId, string $code): void
    {
        $userId = $this->userService->extractCode($code);
        $data = [
            "team_id" => $teamId,
            "member_id" => $userId['id']
        ];

        DB::transaction(function () use ($data) {
            $this->teamMemberDao->store($this->teamMemberData::from($data));
        });
    }

    public function delete(int $id): void
    {
        DB::transaction(function () use ($id) {
            $this->teamMemberDao->delete($id);
        });
    }
}
