<?php

namespace App\Dao;

use App\Contracts\Dao\ProjectDaoInterface;
use App\Data\Project\CreateProjectData;
use App\Data\Project\UpdateProjectData;
use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * handles data access to projects db
 */
class ProjectDao implements ProjectDaoInterface
{
    /**
     * project dao constructor
     * @param Project $project inject the project model
     */
    public function __construct(
        protected Project $project
    ) {}

    public function getPending(): LengthAwarePaginator
    {
        $pending = $this->project::whereDoesntHave(
            'tasks',
            fn(Builder $query) => $query->whereNot('state', Task::PENDING)
        );

        return $this->getProject($pending);
    }

    public function getProcessing(): LengthAwarePaginator
    {
        $processing = $this->project::whereHas(
            'tasks',
            fn(Builder $query) => $query->whereIn('state', [Task::DEVELOPING, Task::TESTING, Task::FIXING])
        );

        return $this->getProject($processing);
    }

    public function getCompleted(): LengthAwarePaginator
    {
        $completed = $this->project::whereDoesntHave(
            'tasks',
            fn(Builder $query) => $query->whereNot('state', Task::COMPLETED)
        )
            ->whereHas('tasks');

        return $this->getProject($completed);
    }

    public function getDetail(int $id): Project
    {
        return $this->project::with([
            'owner:id,name,role',
            'recipient:id,name',
            'type:id,label',
            'tasks:id,code,project_id,priority,state,percentage,start_date,end_date'
        ])
            ->findOrFail($id);
    }

    public function store(CreateProjectData $data): Project
    {
        return $this->project::create($data->toArray());
    }

    public function update(int $id, UpdateProjectData $data): void
    {
        $this->project::findOrFail($id)
            ->update($data->toArray());
    }

    public function delete(int $id): void
    {
        $this->project::findOrFail($id)
            ->delete();
    }

    public function countByDate(Carbon $date): int
    {
        return $this->project::whereDate('created_at', $date)
            ->count();
    }

    /**
     * build common project query with pagination
     * @param \Illuminate\Contracts\Database\Eloquent\Builder|Project $query
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    protected function getProject(Builder|Project $query): LengthAwarePaginator
    {
        return $query->limit(config('constants.LOAD_LIMIT'))
            ->orderBy('end_date')
            ->orderBy('priority')
            ->paginate();
    }
}
