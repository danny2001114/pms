<?php

namespace App\Services;

use App\Contracts\Dao\TeamDaoInterface;
use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\TeamServiceInterface;
use App\Data\Team\UpdateTeamData;
use App\Data\Team\CreateTeamData;
use App\Http\Requests\Team\TeamRequest;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;

class TeamService implements TeamServiceInterface
{
    protected $createTeamData = CreateTeamData::class;
    protected $updateTeamData = UpdateTeamData::class;

    public function __construct(
        protected TeamDaoInterface $teamDao,
        protected UserDaoInterface $userDao
    ) {}

    public function getList(): Collection
    {
        return $this->teamDao->getList();
    }

    public function store(TeamRequest $request): Team
    {
        $data = $request->validated();

        if ($data['leader_code']) {
            $data['leader_id'] = $this->userDao->getByAttribute('code', $data['leader_code'])->id;
        }

        return $this->teamDao->store(
            $this->createTeamData::from($data)
        );
    }

    public function show(int $id): Team
    {
        return $this->teamDao->show($id);
    }

    public function update(int $id, TeamRequest $request): void
    {
        $data = $request->validated();
        $data['leader_id'] = $request->leader_id;

        $this->teamDao->update(
            $id,
            $this->updateTeamData::from($data)
        );
    }

    public function destroy(int $id): void
    {
        $this->teamDao->destroy($id);
    }

    public function count(): int
    {
        return $this->teamDao->count();
    }
}
