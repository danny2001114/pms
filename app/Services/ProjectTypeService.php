<?php

namespace App\Services;

use App\Contracts\Dao\ProjectTypeDaoInterface;
use App\Contracts\Services\ProjectTypeServiceInterface;
use App\Dto\ProjectType\ProjectTypeDto;
use App\Http\Requests\ProjectTypeRequest;
use App\Models\ProjectType;
use Illuminate\Database\Eloquent\Collection;

class ProjectTypeService implements ProjectTypeServiceInterface
{
    protected $projectTypeDto = ProjectTypeDto::class;

    public function __construct(
        protected ProjectTypeDaoInterface $projectTypeDao
    )
    {}

    public function getList(?array $filter = []): Collection
    {
        return $this->projectTypeDao->getList($filter);
    }

    public function store(ProjectTypeRequest $request): ProjectType
    {
        return $this->projectTypeDao->store(
            $this->projectTypeDto::pack($request->validated())
        );
    }

    public function update(ProjectTypeRequest $request, int $id): ProjectType
    {
        return $this->projectTypeDao->update($id,
            $this->projectTypeDto::pack($request->validated())
        );
    }
    
    public function delete(int $id): int
    {
        return $this->projectTypeDao->delete($id);
    }

    public function getTotalCount(array $filter): int
    {
        return $this->projectTypeDao->getTotalCount($filter);
    }
}
