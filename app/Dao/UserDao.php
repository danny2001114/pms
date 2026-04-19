<?php

namespace App\Dao;

use App\Contracts\Dao\UserDaoInterface;
use App\Data\User\CreateUserData;
use App\Data\User\UpdateUserData;
use App\Models\User;
use Illuminate\Cache\Events\RetrievingKey;
use Illuminate\Database\Eloquent\Collection;

class UserDao implements UserDaoInterface
{
    public function __construct(
        protected User $user
    ) {}

    public function getList(): Collection
    {
        return $this->user::get();
    }

    public function store(CreateUserData $data): User|null
    {
        return $this->user::create($data->toArray());
    }

    public function show(int $id): User
    {
        return $this->user::findOrFail($id);
    }

    public function update(int $id, UpdateUserData $data): void
    {
        $this->user::findOrFail($id)->update($data->toArray());
    }

    public function destroy(int $id): void
    {
        $this->user::findOrFail($id)->delete();
    }

    public function countByRole(int $role): int
    {
        return $this->user::where('role', $role)->count();
    }

    public function getByAttribute(string $attribute, mixed $value): User
    {
        return $this->user::where($attribute, $value)
            ->first();
    }

    public function isSuperAdmin(int $id): bool
    {
        return $this->user::where('id', $id)
            ->where('role', $this->user::SUPER)
            ->exists();
    }
}
