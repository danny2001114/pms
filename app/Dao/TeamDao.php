<?php

namespace App\Dao;

use App\Contracts\Dao\TeamDaoInterface;
use App\Data\Team\CreateTeamData;
use App\Data\Team\UpdateTeamData;
use App\Models\Team;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * handles data access to teams db
 */
class TeamDao implements TeamDaoInterface
{
    /**
     * team dao constructor
     * @param Team $team inject the team model
     */
    public function __construct(
        protected Team $team
    ) {}

    public function getList(): LengthAwarePaginator
    {
        return $this->team::with('leader:id,name')
            ->withCount(['members'])
            ->paginate();
    }

    public function store(CreateTeamData $data): Team
    {
        $data = $data->toArray();
        $team = $this->team::create($data);
        $team->members()->create([
            'member_id' => $data["leader_id"]
        ]);

        return $team;
    }

    public function getDetail(int $id): Team
    {
        return $this->team::with([
            'leader:id,name,role',
            'members.user:id,name,role'
        ])
            ->withCount(['members'])
            ->findOrFail($id);
    }

    public function update(int $id, UpdateTeamData $data): void
    {
        $this->team::findOrFail($id)
            ->update($data->toArray());
    }

    public function delete(int $id): void
    {
        $this->team::findOrFail($id)
            ->delete();
    }
}
