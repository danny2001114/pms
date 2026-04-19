<?php

namespace App\Contracts\Dao;

use App\Data\Team\CreateTeamData;
use App\Data\Team\UpdateTeamData;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;

interface TeamDaoInterface
{
    public function getList(): Collection;
    public function store(CreateTeamData $data): Team;
    public function show(int $id): Team;
    public function update(int $id, UpdateTeamData $data): void;
    public function destroy(int $id): void;
    public function count(): int;
}
