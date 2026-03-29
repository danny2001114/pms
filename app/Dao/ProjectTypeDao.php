<?php

namespace App\Dao;

use App\Contracts\Dao\ProjectTypeDaoInterface;
use App\Models\ProjectType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProjectTypeDao implements ProjectTypeDaoInterface
{
    public function __construct(
        protected ProjectType $projectType
    )
    {}

    public function getList(array $filter): Collection
    {
        return $this->buildSearchQuery($filter)
                    ->orderByDesc("id")
                    ->limit(config("constants.LOAD_LIMIT"))
                    ->get();
    }

    public function store(array $dto): ProjectType
    {
        return $this->projectType::create($dto);
    }

    public function update(int $id, array $dto): ProjectType
    {
        $model = $this->projectType::findOrFail($id);
        $model->update($dto);

        return $model->fresh();
    }

    public function delete(int $id): int
    {
        return $this->projectType::findOrFail($id)
                                    ->delete();
    }

    public function getTotalCount(array $filter): int
    {
        return $this->buildSearchQuery($filter)->count();
    }

    protected function buildSearchQuery(array $filter): Builder
    {
        return $this->projectType::when($filter['label'] ?? null, 
                                    fn ($query) => $query->where('label', 'LIKE', "%{$filter['label']}%"))
                                ->when(is_bool($filter['active'] ?? null), 
                                    fn ($query) => $query->where('active', $filter['active'])) ;
    }
}
