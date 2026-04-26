<?php

namespace App\Dao;

use App\Contracts\Dao\UserDaoInterface;
use App\Data\User\CreateUserData;
use App\Data\User\UpdateUserData;
use App\Models\User;
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

    /**
     * @inheritDoc
     */
    public function getList(): Collection
    {
        return $this->user::get();
    }

    /**
     * @inheritDoc
     */
    public function store(CreateUserData $data): User|null
    {
        return $this->user::create($data->toArray());
    }

    /**
     * @inheritDoc
     */
    public function getDetail(int $id): User
    {
        return $this->user::findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, UpdateUserData $data): void
    {
        $this->user::findOrFail($id)->update($data->toArray());
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): void
    {
        $this->user::findOrFail($id)->delete();
    }

    /**
     * @inheritDoc
     */
    public function getByAttribute(string $attribute, mixed $value): User
    {
        return $this->user::where($attribute, $value)
            ->first();
    }

    /**
     * @inheritDoc
     */
    public function isSuperAdmin(int $id): bool
    {
        return $this->user::where('id', $id)
            ->where('role', $this->user::SUPER)
            ->exists();
    }
}
