<?php

namespace App\Services;

use App\Contracts\Dao\ProjectDaoInterface;
use App\Contracts\Services\ProjectServiceInterface;
use App\Dto\Project\ProjectCreateDto;
use App\Dto\Project\ProjectUpdateDto;
use App\Http\Requests\ProjectRequest;
use Illuminate\Database\Eloquent\Collection;

class ProjectService implements ProjectServiceInterface
{
    protected $projectCreateDto = ProjectCreateDto::class;
    protected $projectUpdateDto = ProjectUpdateDto::class;

    public function __construct(
        protected ProjectDaoInterface $projectDao
    )
    {}

    public function getList(?int $lastId): Collection
    {
        return $this->projectDao->getList($lastId);
    }

    public function store(ProjectRequest $request): void
    {
        $this->projectDao->store(
            $this->projectCreateDto::pack($request->validated())
        );
    }

    public function update(ProjectRequest $request, int $id): void
    {
        $this->projectDao->update($id, 
            $this->projectUpdateDto::pack($request->validated())
        );
    }

    public function delete(int $id): void
    {
        $this->projectDao->delete($id);
    }
}
