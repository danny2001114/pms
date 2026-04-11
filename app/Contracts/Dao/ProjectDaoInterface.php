<?php

namespace App\Contracts\Dao;

use App\Data\Project\CreateProjectData;
use App\Data\Project\UpdateProjectData;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

interface ProjectDaoInterface
{
    public function getPending(): Collection;
    public function getProcessing(): Collection;
    public function getCompleted(): Collection;
    public function show(int $id): Project;
    public function store(CreateProjectData $data): Project;
    public function update(int $id, UpdateProjectData $data): void;
    public function destroy(int $id): void;
    public function countByDate(Carbon $date): int;
}
