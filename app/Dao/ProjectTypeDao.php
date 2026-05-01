<?php

namespace App\Dao;

use App\Contracts\Dao\ProjectTypeDaoInterface;
use App\Data\ProjectType\ProjectTypeData;
use App\Models\ProjectType;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * handles data access to project_types db
 */
class ProjectTypeDao implements ProjectTypeDaoInterface
{
    /**
     * project type dao construct
     * @param ProjectType $projectType inject the project type model
     */
    public function __construct(
        protected ProjectType $projectType
    ) {}

    public function getList(array $filter): LengthAwarePaginator
    {
        return $this->projectType::when(
            $filter['label'] ?? null,
            fn($query) => $query->where('label', 'LIKE', "%{$filter['label']}%")
        )
            ->when(
                is_bool($filter['active'] ?? null),
                fn($query) => $query->where('active', $filter['active'])
            )
            ->orderByDesc("id")
            ->paginate();
    }

    public function store(ProjectTypeData $data): void
    {
        $this->projectType::create($data->toArray());
    }

    public function update(int $id, ProjectTypeData $data): void
    {
        $this->projectType::findOrFail($id)
            ->update($data->toArray());
    }

    public function destroy(int $id): void
    {
        $this->projectType::findOrFail($id)
            ->delete();
    }
}
