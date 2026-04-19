<?php

namespace App\Services;

use App\Contracts\Dao\TeamMemberDaoInterface;
use App\Contracts\Services\TeamMemberServiceInterface;
use App\Data\TeamMemberData;

class TeamMemberService implements TeamMemberServiceInterface
{
    protected $teamData = TeamMemberData::class;

    public function __construct(
        protected TeamMemberDaoInterface $teamDao
    ) {}
}
