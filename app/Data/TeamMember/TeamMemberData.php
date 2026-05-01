<?php

namespace App\Data\TeamMember;

use Spatie\LaravelData\Data;

class TeamMemberData extends Data
{
    public function __construct(
        public readonly int $team_id,
        public readonly int $member_id
    ) {}
}
