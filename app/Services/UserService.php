<?php

namespace App\Services;

use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Data\User\CreateUserData;
use App\Data\User\UpdateUserData;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService implements UserServiceInterface
{
    protected $createUserData = CreateUserData::class;
    protected $updateUserData = UpdateUserData::class;

    public function __construct(
        protected UserDaoInterface $userDao
    ) {}

    public function getList(): Collection
    {
        return $this->userDao->getList();
    }

    public function store(UserRequest $request): User|null
    {        
        return DB::transaction(function () use ($request) {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            return $this->userDao->store($this->createUserData::from($data));
        });
    }

    public function show(int $id): User
    {
        return $this->userDao->show($id);
    }

    public function update(int $id, UserRequest $request): void
    {
        DB::transaction(function () use ($id, $request) {
            $this->userDao->update($id, $this->updateUserData::from($request));
        });
    }

    public function destroy(int $id): void
    {
        DB::transaction(function () use ($id) {
            $this->userDao->destroy($id);
        });
    }

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

    public function isSuperAdmin(int $id): bool
    {
        return $this->userDao->isSuperAdmin($id);
    }
}
