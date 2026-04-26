<?php

namespace App\Dao;

use App\Contracts\Dao\TeamDaoInterface;
use App\Data\Team\CreateTeamData;
use App\Data\Team\UpdateTeamData;
use App\Models\Team;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    /**
     * @inheritDoc
     */
    public function getList(): LengthAwarePaginator
    {
        return $this->team::with('leader:id,name')
            ->withCount(['members'])
            ->paginate();
    }

    /**
     * @inheritDoc
     */
    public function store(CreateTeamData $data): Team
    {
        $data = $data->toArray();
        $team = $this->team::create($data);
        $team->members()->create([
            'member_id' => $data["leader_id"]
        ]);

        return $team;
    }

    /**
     * @inheritDoc
     */
    public function getDetail(int $id): Team
    {
        return $this->team::with([
            'leader:id,name,role',
            'members' => function (HasMany $query) {
                $query->select('team_id', 'member_id', "id")
                    ->with('user:id,name');
            },
        ])
            ->withCount(['members'])
            ->findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, UpdateTeamData $data): void
    {
        $this->team::findOrFail($id)
            ->update($data->toArray());
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): void
    {
        $this->team::findOrFail($id)
            ->delete();
    }
}
