<?php

namespace App\Dao;

use App\Contracts\Dao\TeamMemberDaoInterface;
use App\Data\TeamMember\TeamMemberData;
use App\Models\TeamMember;

/**
 * handles data access to team_members db
 */
class TeamMemberDao implements TeamMemberDaoInterface
{
    /**
     * team member dao constructor
     * @param TeamMember $teamMember inject the team member model
     */
    public function __construct(
        protected TeamMember $teamMember
    ) {}

    public function store(TeamMemberData $data): void
    {
        $this->teamMember::create($data->toArray());
    }

    public function delete(int $id): void
    {
        $this->teamMember::findOrFail($id)->forceDelete();
    }
}
