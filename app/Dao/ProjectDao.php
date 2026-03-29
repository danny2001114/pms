<?php

namespace App\Dao;

use App\Contracts\Dao\ProjectDaoInterface;
use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProjectDao implements ProjectDaoInterface
{
    public function __construct(
        protected Project $project
    )
    {}

    public function getList(?int $lastId): Collection
    {
        return $this->project::when($lastId, fn (Builder $query) => $query->where("id", ">", $lastId))
                            ->limit(config("constants.LOAD_LIMIT"))
                            ->get();
    }

    public function store(array $dto): void
    {
        $this->project::create($dto);
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
}
