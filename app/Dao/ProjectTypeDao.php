<?php

namespace App\Dao;

use App\Contracts\Dao\ProjectTypeDaoInterface;
use App\Data\ProjectType\ProjectTypeData;
use App\Models\ProjectType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProjectTypeDao implements ProjectTypeDaoInterface
{
    public function __construct(
        protected ProjectType $projectType
    ) {}

    public function getList(array $filter): Collection
    {
        return $this->buildSearchQuery($filter)
            ->orderByDesc("id")
            ->limit(config("constants.LOAD_LIMIT"))
            ->get();
    }

    public function store(ProjectTypeData $data): ProjectType
    {
        return $this->projectType::create($data->toArray());
    }

    public function update(int $id, ProjectTypeData $data): ProjectType
    {
        $model = $this->projectType::findOrFail($id);
        $model->update($data->toArray());

        return $model->fresh();
    }

    public function destroy(int $id): int
    {
        return $this->projectType::findOrFail($id)
            ->delete();
    }

    public function count(array $filter): int
    {
        return $this->buildSearchQuery($filter)
            ->count();
    }

    protected function buildSearchQuery(array $filter): Builder
    {
        return $this->projectType::when(
            $filter['label'] ?? null,
            fn($query) => $query->where('label', 'LIKE', "%{$filter['label']}%")
        )
            ->when(
                is_bool($filter['active'] ?? null),
                fn($query) => $query->where('active', $filter['active'])
            );
    }
}
