<?php

namespace App\Contracts\Services;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;

interface ProjectServiceInterface
{
    public function getList(): array;
    public function getDetail(int $id): Project;
    public function store(ProjectRequest $request): void;
    public function update(ProjectRequest $request, int $id): void;
    public function delete(int $id): void;
}
