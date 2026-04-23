<?php

namespace App\Services;

use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Data\User\CreateUserData;
use App\Data\User\UpdateUserData;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * handles business logic related to user operations
 */
class UserService implements UserServiceInterface
{
    /**
     * data transfer object class used for creating user data.
     * @var string
     */
    protected string $createUserData = CreateUserData::class;

    /**
     * data transfer object class used for updating user data.
     * @var string
     */
    protected string $updateUserData = UpdateUserData::class;

    /**
     * user service constructor
     * @param UserDaoInterface $userDao inject the user data access object
     */
    public function __construct(
        protected UserDaoInterface $userDao
    ) {}

    /**
     * get user list
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getList(): Collection
    {
        return $this->userDao->getList();
    }

    /**
     * store user with validated data
     * @param UserRequest $request validated user data
     * @return User|null
     */
    public function store(UserRequest $request): User|null
    {        
        return DB::transaction(function () use ($request) {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            return $this->userDao->store($this->createUserData::from($data));
        });
    }

    /**
     * get user detail
     * @param int $id user id
     * @return User
     */
    public function show(int $id): User
    {
        return $this->userDao->show($id);
    }

    /**
     * update user with validated data
     * @param int $id user id
     * @param UserRequest $request validated user data
     * @return void
     */
    public function update(int $id, UserRequest $request): void
    {
        DB::transaction(function () use ($id, $request) {
            $this->userDao->update($id, $this->updateUserData::from($request));
        });
    }

    /**
     * delete user
     * @param int $id user id
     * @return void
     */
    public function destroy(int $id): void
    {
        DB::transaction(function () use ($id) {
            $this->userDao->destroy($id);
        });
    }

    /**
     * check user credentials to database
     * @param array $credentials user login credentials 
     * @return bool
     */
    public function attempt(array $credentials): bool
    {
        foreach (config('constants.USER.ROLES.TEXT') as $roleId => $role) {
            if ($role[0] === $credentials['code'][0]) {
                $id = (int) Str::substr($credentials['code'], 2);
                return Auth::attempt([
                    'id' => $id,
                    'role' => $roleId,
                    'password' => $credentials['password']
                ]);
            }
        }

        return false;
    }

    /**
     * check user is super admin or not
     * @param int $id user id
     * @return bool
     */
    public function isSuperAdmin(int $id): bool
    {
        return $this->userDao->isSuperAdmin($id);
    }
}
