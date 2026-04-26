<?php

namespace App\Contracts\Services;

use App\Http\Requests\Team\TeamRequest;
use App\Models\Team;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * defines the contract for team related business logic
 */
interface TeamServiceInterface
{
    /**
     * get team list
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getList(): LengthAwarePaginator;
    /**
     * store team with validated data. Also add the leader as a team member
     * @param TeamRequest $request validated team data
     * @return Team
     */
    public function store(TeamRequest $request): Team;
    /**
     * get team detail
     * @param int $id team id
     * @return Team
     */
    public function getDetail(int $id): Team;
    /**
     * update team with validated data
     * @param int $id team id
     * @param TeamRequest $request validated team data
     * @return void
     */
    public function update(int $id, TeamRequest $request): void;
    /**
     * delete team
     * @param int $id team id
     * @return void
     */
    public function delete(int $id): void;
}
