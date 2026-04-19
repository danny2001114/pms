<?php

namespace App\Services;

use App\Contracts\Dao\ProjectTypeDaoInterface;
use App\Contracts\Services\ProjectTypeServiceInterface;
use App\Data\ProjectType\ProjectTypeData;
use App\Http\Requests\ProjectType\ProjectTypeRequest;
use App\Models\ProjectType;
use Illuminate\Database\Eloquent\Collection;

class ProjectTypeService implements ProjectTypeServiceInterface
{
    protected $projectTypeData = ProjectTypeData::class;

    public function __construct(
        protected ProjectTypeDaoInterface $projectTypeDao
    ) {}

    public function getList(?array $filter = []): Collection
    {
        return $this->projectTypeDao->getList($filter);
    }

    public function store(ProjectTypeRequest $request): ProjectType
    {
        return $this->projectTypeDao->store(
            $this->projectTypeData::from($request->validated())
        );
    }

    public function update(ProjectTypeRequest $request, int $id): ProjectType
    {
        return $this->projectTypeDao->update(
            $id,
            $this->projectTypeData::from($request->validated())
        );
    }

    public function destroy(int $id): int
    {
        return $this->projectTypeDao->destroy($id);
    }

    public function count(array $filter): int
    {
        return $this->projectTypeDao->count($filter);
    }
}
