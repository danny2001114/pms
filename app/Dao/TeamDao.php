<?php

namespace App\Dao;

use App\Contracts\Dao\TeamDaoInterface;
use App\Data\Team\CreateTeamData;
use App\Data\Team\UpdateTeamData;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TeamDao implements TeamDaoInterface
{
    public function __construct(
        protected Team $team
    ) {}

    public function getList(): Collection
    {
        return $this->team::withCount(['members'])
            ->get();
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

    public function show(int $id): Team
    {
        return $this->team::with([
            'leader:id,name,code',
            'members' => function (HasMany $query) {
                $query->select('team_id', 'member_id', "id")
                    ->with('user:id,name,code')
                    ->get();
            },
        ])
            ->withCount(['members'])
            ->findOrFail($id);
    }

    public function update(int $id, UpdateTeamData $data): void
    {
        $this->team::findOrFail($id)
            ->update($data->toArray());
    }

    public function destroy(int $id): void
    {
        $this->team::findOrFail($id)
            ->delete();
    }

    public function count(): int
    {
        return $this->team::count();
    }
}
