<?php

namespace App\Contracts\Services;

use App\Http\Requests\ProjectRequest;
use Illuminate\Database\Eloquent\Collection;

interface ProjectServiceInterface
{
    public function getList(?int $lastId): Collection;
    public function store(ProjectRequest $request): void;
    public function update(ProjectRequest $request, int $id): void;
    public function delete(int $id): void;
}
