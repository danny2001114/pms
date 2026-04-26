<?php

namespace App\Services;

use App\Contracts\Dao\TeamDaoInterface;
use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\TeamServiceInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Data\Team\UpdateTeamData;
use App\Data\Team\CreateTeamData;
use App\Http\Requests\Team\TeamRequest;
use App\Models\Team;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * handles business logic related to team operations
 */
class TeamService implements TeamServiceInterface
{
    /**
     * data transfer object class used for creating team data.
     * @var string
     */
    protected string $createTeamData = CreateTeamData::class;

    /**
     * data transfer object class used for updating user data.
     * @var string
     */
    protected string $updateTeamData = UpdateTeamData::class;

    /**
     * team service constructor
     * @param TeamDaoInterface $teamDao inject the team data access object
     * @param UserDaoInterface $userDao inject the user data access object
     * @param UserServiceInterface $userService inject the user service
     */
    public function __construct(
        protected TeamDaoInterface $teamDao,
        protected UserDaoInterface $userDao,
        protected UserServiceInterface $userService
    ) {}

    /**
     * @inheritDoc
     */
    public function getList(): LengthAwarePaginator
    {
        return $this->teamDao->getList();
    }

    /**
     * @inheritDoc
     */
    public function store(TeamRequest $request): Team
    {
        $data = $request->validated();
        if ($data['leader_code']) {
            $data['leader_id'] = $this->userService->extractCode($data['leader_code'])['id'];
        }

        return DB::transaction(function () use ($data) {
            return $this->teamDao->store($this->createTeamData::from($data));
        });
    }

    /**
     * @inheritDoc
     */
    public function getDetail(int $id): Team
    {
        return $this->teamDao->getDetail($id);
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, TeamRequest $request): void
    {
        $data = $request->validated();
        if ($data['leader_code']) {
            $data['leader_id'] = $this->userService->extractCode($data['leader_code'])['id'];
        }

        DB::transaction(function () use ($id, $data) {
            $this->teamDao->update($id, $this->updateTeamData::from($data));
        });
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): void
    {
        DB::transaction(function () use ($id) {
            $this->teamDao->delete($id);
        });
    }
}
