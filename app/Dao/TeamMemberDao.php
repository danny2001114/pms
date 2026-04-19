<?php

namespace App\Dao;

use App\Contracts\Dao\TeamMemberDaoInterface;
use App\Models\TeamMember;

class TeamMemberDao implements TeamMemberDaoInterface
{
    public function __construct(
        protected TeamMember $team
    ) {}
}
