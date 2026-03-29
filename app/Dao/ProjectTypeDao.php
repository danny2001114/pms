<?php

namespace App\Dao;

use App\Contracts\Dao\ProjectTypeDaoInterface;
use App\Models\ProjectType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProjectTypeDao implements ProjectTypeDaoInterface
{
    public function __construct(
        protected ProjectType $projectType
    )
    {}

    public function getList(array $filter): Collection
    {
        return $this->projectType::when($filter["last_id"] ?? null, 
                                    fn (Builder $query) => $query->where("id", "<", $filter["last_id"]))
                                ->when($filter["label"] ?? null, 
                                    fn (Builder $query) => $query->where("label", "LIKE", "%{$filter['label']}%"))
                                ->orderByDesc("id")
                                ->limit(config("constants.LOAD_LIMIT"))
                                ->get();
    }

    public function store(array $dto): ProjectType
    {
        return $this->projectType::create($dto);
    }

    public function update(int $id, array $dto): ProjectType
    {
        $model = $this->projectType::findOrFail($id);
        $model->update($dto);

        return $model->fresh();
    }

    public function delete(int $id): int
    {
        return $this->projectType::findOrFail($id)
                                    ->delete();
    }

    public function getTotalCount(array $filter): int
    {
        return $this->projectType::when($filter["label"] ?? null, 
                                    fn (Builder $query) => $query->where("label", "LIKE", "%{$filter['label']}%"))
                                ->count();
    }

    protected function buildSearchQuery(Request $request): Builder
    {
        return $this->projectType::when($request->get('label'), 
                                    fn ($query) => $query->where('label', 'LIKE', "%{$request->label}%"))
                                ->when(is_bool($request->get('active')), 
                                    fn ($query) => $query->where('active', $request->active)) ;
    }
}
