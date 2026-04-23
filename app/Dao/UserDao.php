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
     * get user list
     * @return Collection<int, User>|\Illuminate\Support\Collection<int, \stdClass>
     */
    public function getList(): Collection
    {
        return $this->user::get();
    }

    /**
     * store user data from data transfer object of user creating
     * @param CreateUserData $data data transfer object class used for creating user data
     * @return User
     */
    public function store(CreateUserData $data): User|null
    {
        return $this->user::create($data->toArray());
    }

    /**
     * get user detail
     * @param int $id user id
     * @return User
     */
    public function show(int $id): User
    {
        return $this->user::findOrFail($id);
    }

    /**
     * update user data from data transfer object of user updating
     * @param int $id data transfer object class used for updating user data
     * @return void
     */
    public function update(int $id, UpdateUserData $data): void
    {
        $this->user::findOrFail($id)->update($data->toArray());
    }

    /**
     * delete user
     * @param int $id user id
     * @return void
     */
    public function destroy(int $id): void
    {
        $this->user::findOrFail($id)->delete();
    }

    /**
     * serach user by column name
     * @param string $attribute table column name
     * @param mixed $value column value
     * @return object|User|null
     */
    public function getByAttribute(string $attribute, mixed $value): User
    {
        return $this->user::where($attribute, $value)
            ->first();
    }

    /**
     * check is super admin or not
     * @param int $id user id
     * @return bool
     */
    public function isSuperAdmin(int $id): bool
    {
        return $this->user::where('id', $id)
            ->where('role', $this->user::SUPER)
            ->exists();
    }
}
