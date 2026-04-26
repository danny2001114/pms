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
     * @return User
     */
    public function store(UserRequest $request): User;
    /**
     * get user detail
     * @param int $id user id
     * @return User
     */
    public function getDetail(int $id): User;
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
    public function delete(int $id): void;
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
    /**
     * extract id and role from code
     * @param string|null $code user code
     * @return array{id: int, role: int}
     */
    public function extractCode(?string $code = null): array;
}
