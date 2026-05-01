<?php

namespace App\Contracts\Dao;

use App\Data\TeamMember\TeamMemberData;

/**
 * define the contract for team member data access object
 */
interface TeamMemberDaoInterface
{
    /**
     * store member data from data transfer object of team member
     * @param TeamMemberData $data
     * @return void
     */
    public function store(TeamMemberData $data): void;
    /**
     * delete member
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;
}
