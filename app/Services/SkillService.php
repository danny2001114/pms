<?php

namespace App\Services;

use App\Contracts\Dao\SkillDaoInterface;
use App\Contracts\Services\SkillServiceInterface;
use App\Data\Skill\SkillData;
use App\Http\Requests\Skill\SkillRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * handles business logic related to skill operations
 */
class SkillService implements SkillServiceInterface
{
    /**
     * data transfer object class used for managing skill data.
     * @var string
     */
    protected string $skillData = SkillData::class;

    /**
     * skill service constructor
     * @param SkillDaoInterface $skillDao inject the skill data access object
     */
    public function __construct(
        protected SkillDaoInterface $skillDao
    ) {}

    public function getList(?array $filter = []): LengthAwarePaginator
    {
        return $this->skillDao->getList($filter);
    }

    public function store(SkillRequest $request): void
    {
        DB::transaction(function () use ($request) {
            $this->skillDao->store($this->skillData::from($request->validated()));
        });
    }

    public function update(int $id, SkillRequest $request): void
    {
        DB::transaction(function () use ($id, $request) {
            $this->skillDao->update($id, $this->skillData::from($request->validated()));
        });
    }

    public function destroy(int $id): void
    {
        DB::transaction(function () use ($id) {
            $this->skillDao->destroy($id);
        });
    }
}
