<?php

namespace App\Contracts\Services;

use App\Http\Requests\Project\ProjectRequest;
use App\Models\Project;

interface ProjectServiceInterface
{
    public function getList(): array;
    public function show(int $id): Project;
    public function store(ProjectRequest $request): Project;
    public function update(ProjectRequest $request, int $id): void;
    public function destroy(int $id): void;
}
