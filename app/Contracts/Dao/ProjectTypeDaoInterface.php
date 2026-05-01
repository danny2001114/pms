<?php

namespace App\Contracts\Dao;

use App\Data\ProjectType\ProjectTypeData;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * define the contract for user project type access object
 */
interface ProjectTypeDaoInterface
{
    /**
     * get project type list
     * @param array $filter
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getList(array $filter): LengthAwarePaginator;
    /**
     * store project type data from data transfer object of project type data
     * @param ProjectTypeData $data data transfer object class used for creating project type data
     * @return void
     */
    public function store(ProjectTypeData $data): void;
    /**
     * update project type data from data transfer object of project type data
     * @param int $id project type id
     * @param ProjectTypeData $data data transfer object class used for updating project type data
     * @return void
     */
    public function update(int $id, ProjectTypeData $data): void;
    /**
     * delete project type
     * @param int $id project type id
     * @return void
     */
    public function destroy(int $id): void;
}
