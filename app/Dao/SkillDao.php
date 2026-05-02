<?php

namespace App\Dao;

use App\Contracts\Dao\SkillDaoInterface;
use App\Data\Skill\SkillData;
use App\Models\Skill;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * handles data access to skills db
 */
class SkillDao implements SkillDaoInterface
{
    /**
     * skill dao construct
     * @param Skill $skill inject the skill model
     */
    public function __construct(
        protected Skill $skill
    ) {}

    public function getList(array $filter): LengthAwarePaginator
    {
        return $this->skill::when(
            $filter['name'] ?? null,
            fn($query) => $query->where('name', 'LIKE', "%{$filter['name']}%")
        )
            ->when(
                is_bool($filter['active'] ?? null),
                fn($query) => $query->where('active', $filter['active'])
            )
            ->orderByDesc("id")
            ->paginate();
    }

    public function store(SkillData $data): void
    {
        $this->skill::create($data->toArray());
    }

    public function update(int $id, SkillData $data): void
    {
        $this->skill::findOrFail($id)
            ->update($data->toArray());
    }

    public function destroy(int $id): void
    {
        $this->skill::findOrFail($id)
            ->delete();
    }
}
