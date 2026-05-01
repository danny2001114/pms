<?php

namespace App\Dao;

use App\Contracts\Dao\UserDaoInterface;
use App\Data\User\CreateUserData;
use App\Data\User\UpdateUserData;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * handles data access to users db
 */
class UserDao implements UserDaoInterface
{
    /**
     * user dao constructor
     * @param User $user inject the user model
     */
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

    public function getDetail(int $id): User
    {
        return $this->user::findOrFail($id);
    }

    public function update(int $id, UpdateUserData $data): void
    {
        $this->user::findOrFail($id)->update($data->toArray());
    }

    public function delete(int $id): void
    {
        $this->user::findOrFail($id)->delete();
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

    public function isValidUser(int $id, int $role): bool
    {
        return $this->user::where('id', $id)
            ->where('role', $role)
            ->whereDoesntHave('members')
            ->exists();
    }
}
