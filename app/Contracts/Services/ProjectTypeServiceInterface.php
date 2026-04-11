<?php

namespace App\Contracts\Services;

use App\Http\Requests\ProjectType\ProjectTypeRequest;
use App\Models\ProjectType;
use Illuminate\Database\Eloquent\Collection;

interface ProjectTypeServiceInterface
{
    public function getList(?array $filter = []): Collection;
    public function store(ProjectTypeRequest $request): ProjectType;
    public function update(ProjectTypeRequest $request, int $id): ProjectType;
    public function destroy(int $id): int;
    public function count(array $filter): int;
}
