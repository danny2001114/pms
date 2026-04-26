<?php

namespace App\Contracts\Dao;

use App\Data\Team\CreateTeamData;
use App\Data\Team\UpdateTeamData;
use App\Models\Team;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * define the contract for team data access object
 */
interface TeamDaoInterface
{
    /**
     * get team list with total members of each
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getList(): LengthAwarePaginator;
    /**
     * store team data from data transfer object of team creating. Also add the leader as a team member
     * @param CreateTeamData $data data transfer object class used for creating team data
     * @return Team
     */
    public function store(CreateTeamData $data): Team;
    /**
     * get team detail with leader data and member count
     * @param int $id team id
     * @return Team
     */
    public function getDetail(int $id): Team;
    /**
     * update team data from data transfer object of team updating
     * @param int $id team id
     * @param UpdateTeamData $data data transfer object class used for updating team data
     * @return void
     */
    public function update(int $id, UpdateTeamData $data): void;
    /**
     * delete team
     * @param int $id team id
     * @return void
     */
    public function delete(int $id): void;
}
