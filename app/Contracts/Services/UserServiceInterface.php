<?php

namespace App\Contracts\Services;

use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * defines the contract for user related business logic
 */
interface UserServiceInterface
{
    /**
     * get user list
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getList(): Collection;
    /**
     * store user with validated data
     * @param UserRequest $request validated user data
     * @return User|null
     */
    public function store(UserRequest $request): User|null;
    /**
     * get user detail
     * @param int $id user id
     * @return User
     */
    public function show(int $id): User;
    /**
     * update user with validated data
     * @param int $id user id
     * @param UserRequest $request validated user data
     * @return void
     */
    public function update(int $id, UserRequest $request): void;
    /**
     * delete user
     * @param int $id user id
     * @return void
     */
    public function destroy(int $id): void;
    /**
     * check user credentials to database
     * @param array $credentials user login credentials 
     * @return bool
     */
    public function attempt(array $credentials): bool;
    /**
     * check user is super admin or not
     * @param int $id user id
     * @return bool
     */
    public function isSuperAdmin(int $id): bool;
}
