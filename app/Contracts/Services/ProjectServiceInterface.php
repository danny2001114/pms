<?php

namespace App\Contracts\Services;

use App\Http\Requests\Project\ProjectRequest;
use App\Models\Project;

/**
 * defines the contract for project related business logic
 */
interface ProjectServiceInterface
{
    /**
     * get user list
     * @return array{peding: \Illuminate\Pagination\LengthAwarePaginator, processing: \Illuminate\Pagination\LengthAwarePaginator, completed: \Illuminate\Pagination\LengthAwarePaginator}
     */
    public function getList(): array;
    /**
     * get project detail
     * @param int $id
     * @return Project
     */
    public function getDetail(int $id): Project;
    /**
     * store project with validated data and merged the project owner, created data from current user
     * @param ProjectRequest $request validated project data
     * @return Project
     */
    public function store(ProjectRequest $request): Project;
    /**
     * update project with validated data and if the new owner will update, will extract user id from code
     * @param ProjectRequest $request validated project data
     * @param int $id project id
     * @return void
     */
    public function update(int $id, ProjectRequest $request): void;
    /**
     * delete project
     * @param int $id project id
     * @return void
     */
    public function delete(int $id): void;
}
