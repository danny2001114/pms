<?php

namespace App\Dao;

use App\Contracts\Dao\ProjectDaoInterface;
use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProjectDao implements ProjectDaoInterface
{
    public function __construct(
        protected Project $project
    )
    {}

    public function getPending(): Collection
    {
        $pending = $this->project::whereDoesntHave('tasks', 
                                                    fn (Builder $query) => $query->whereNot('state', Task::PENDING));
        return $this->getProject($pending);
    }

    public function getProcessing(): Collection
    {
        $processing = $this->project::whereHas('tasks', 
                                                fn (Builder $query) => $query->whereIn('state', [Task::DEVELOPING, Task::TESTING, Task::FIXING]));
        return $this->getProject($processing);
    }

    public function getCompleted(): Collection
    {
        $completed = $this->project::whereDoesntHave('tasks', 
                                        fn (Builder $query) => $query->whereNot('state', Task::COMPLETED))
                                   ->whereHas('tasks');
        return $this->getProject($completed);
    }

    public function getDetail(int $id): Project
    {
        return $this->project::with(['owner:id,name,code', 'recipient:id,name', 'type:id,label'])
                             ->findOrFail($id);
    }

    public function store(array $dto): Project
    {
        return $this->project::create($dto);
    }

    public function update(int $id, array $dto): void
    {
        $this->project::findOrFail($id)
                      ->update($dto);
    }

    public function delete(int $id): void
    {
        $this->project::findOrFail($id)
                      ->delete();
    }

    public function getCountByDate(Carbon $date): int
    {
        return $this->project::whereDate('created_at', $date)
                             ->count();
    }
    
    protected function getProject(Builder|Project $query): Collection
    {
        return $query->limit(config('constants.LOAD_LIMIT'))
                     ->orderBy('end_date')
                     ->orderBy('priority')
                     ->get();
    }
}
