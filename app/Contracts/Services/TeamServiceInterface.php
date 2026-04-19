<?php

namespace App\Contracts\Services;

use App\Http\Requests\Team\TeamRequest;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;

interface TeamServiceInterface
{
    public function getList(): Collection;
    public function store(TeamRequest $request): Team;
    public function show(int $id): Team;
    public function update(int $id, TeamRequest $request): void;
    public function destroy(int $id): void;
    public function count(): int;
}
