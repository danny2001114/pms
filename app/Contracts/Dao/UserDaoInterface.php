<?php

namespace App\Contracts\Dao;

use App\Data\User\CreateUserData;
use App\Data\User\UpdateUserData;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserDaoInterface
{
    public function getList(): Collection;
    public function store(CreateUserData $data): User|null;
    public function show(int $id): User;
    public function update(int $id, UpdateUserData $data): void;
    public function destroy(int $id): void;
    public function countByRole(int $role): int;
    public function getByAttribute(string $attribute, mixed $value): User;
    public function isSuperAdmin(int $id): bool;
}
