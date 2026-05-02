<?php

namespace App\Contracts\Services;

use App\Http\Requests\ProjectType\ProjectTypeRequest;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * defines the contract for project type related business logic
 */
interface ProjectTypeServiceInterface
{
    /**
     *  get project type list
     * @param ?array $filter validated search request
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getList(?array $filter = []): LengthAwarePaginator;
    /**
     * store project type with validated data
     * @param ProjectTypeRequest $request validated project type data
     * @return void
     */
    public function store(ProjectTypeRequest $request): void;
    /**
     * update project type with validated data
     * @param int $id project type id
     * @param ProjectTypeRequest $request validated project type data
     * @return void
     */
    public function update(int $id, ProjectTypeRequest $request): void;
    /**
     * delete project type
     * @param int $id project type id
     * @return void
     */
    public function destroy(int $id): void;
}
