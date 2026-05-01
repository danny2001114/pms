<?php

namespace App\Services;

use App\Contracts\Dao\ProjectTypeDaoInterface;
use App\Contracts\Services\ProjectTypeServiceInterface;
use App\Data\ProjectType\ProjectTypeData;
use App\Http\Requests\ProjectType\ProjectTypeRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * handles business logic related to project type operations
 */
class ProjectTypeService implements ProjectTypeServiceInterface
{
    /**
     * data transfer object class used for managing project type data.
     * @var string
     */
    protected string $projectTypeData = ProjectTypeData::class;

    /**
     * project type service constructor
     * @param ProjectTypeDaoInterface $projectTypeDao inject the project type data access object
     */
    public function __construct(
        protected ProjectTypeDaoInterface $projectTypeDao
    ) {}

    public function getList(?array $filter = []): LengthAwarePaginator
    {
        return $this->projectTypeDao->getList($filter);
    }

    public function store(ProjectTypeRequest $request): void
    {
        DB::transaction(function () use ($request) {
            $this->projectTypeDao->store($this->projectTypeData::from($request->validated()));
        });
    }

    public function update(int $id, ProjectTypeRequest $request): void
    {
        DB::transaction(function () use ($id, $request) {
            $this->projectTypeDao->update($id, $this->projectTypeData::from($request->validated()));
        });
    }

    public function destroy(int $id): void
    {
        DB::transaction(function () use ($id) {
            $this->projectTypeDao->destroy($id);
        });
    }
}
