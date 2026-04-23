<?php

namespace App\Contracts\Dao;

use App\Data\User\CreateUserData;
use App\Data\User\UpdateUserData;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * define the contract fpr user data access onject
 */
interface UserDaoInterface
{
    /**
     * get user list
     * @return Collection<int, User>|\Illuminate\Support\Collection<int, \stdClass>
     */
    public function getList(): Collection;
    /**
     * store user data from data transfer object of user creating
     * @param CreateUserData $data data transfer object class used for creating user data
     * @return User
     */
    public function store(CreateUserData $data): User|null;
    /**
     * get user detail
     * @param int $id user id
     * @return User
     */
    public function show(int $id): User;
    /**
     * update user data from data transfer object of user updating
     * @param int $id data transfer object class used for updating user data
     * @return void
     */
    public function update(int $id, UpdateUserData $data): void;
    /**
     * delete user
     * @param int $id user id
     * @return void
     */
    public function destroy(int $id): void;
    /**
     * serach user by column name
     * @param string $attribute table column name
     * @param mixed $value column value
     * @return object|User|null
     */
    public function getByAttribute(string $attribute, mixed $value): User;
    /**
     * check is super admin or not
     * @param int $id user id
     * @return bool
     */
    public function isSuperAdmin(int $id): bool;
}
