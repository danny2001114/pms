<?php

namespace App\Contracts\Services;

use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface UserServiceInterface
{
    public function getList(): Collection;
    public function store(UserRequest $request): User|null;
    public function show(int $id): User;
    public function update(int $id, UserRequest $data): void;
    public function destroy(int $id): void;
    public function attempt(array $credentials): bool;
    public function isSuperAdmin(int $id): bool;
}
