<?php

namespace App\Contracts\Dao;

use App\Data\Project\CreateProjectData;
use App\Data\Project\UpdateProjectData;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * define the contract for user project access object
 */
interface ProjectDaoInterface
{
    /**
     * get project which has not any active state tasks
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPending(): LengthAwarePaginator;
    /**
     * get project which has any active state tasks
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getProcessing(): LengthAwarePaginator;
    /**
     * get project which has all completed state tasks
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getCompleted(): LengthAwarePaginator;
    /**
     * get project detail
     * @param int $id project id
     * @return Project
     */
    public function getDetail(int $id): Project;
    /**
     * store project data from data transfer object of project creating
     * @param CreateProjectData $data data transfer object class used for creating project data
     * @return Project
     */
    public function store(CreateProjectData $data): Project;
    /**
     * update project data from data transfer object of project updating
     * @param int $id project id
     * @param UpdateProjectData $data data transfer object class used for updating project data
     * @return void
     */
    public function update(int $id, UpdateProjectData $data): void;
    /**
     * delete project
     * @param int $id project id
     * @return void
     */
    public function delete(int $id): void;
    /**
     * count the total projects by data
     * @param \Carbon\Carbon $date
     * @return int
     */
    public function countByDate(Carbon $date): int;
}
