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
     * @inheritDoc
     */
    public function getList(): Collection
    {
        return $this->userDao->getList();
    }

    /**
     * @inheritDoc
     */
    public function store(UserRequest $request): User
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        return DB::transaction(function () use ($data) {
            return $this->userDao->store($this->createUserData::from($data));
        });
    }

    /**
     * @inheritDoc
     */
    public function getDetail(int $id): User
    {
        return $this->userDao->getDetail($id);
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, UserRequest $request): void
    {
        DB::transaction(function () use ($id, $request) {
            $this->userDao->update($id, $this->updateUserData::from($request));
        });
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): void
    {
        DB::transaction(function () use ($id) {
            $this->userDao->delete($id);
        });
    }

    /**
     * @inheritDoc
     */
    public function attempt(array $credentials): bool
    {
        return Auth::attempt([
            ...$this->extractCode($credentials['code']),
            'password' => $credentials['password']
        ]);
    }

    /**
     * @inheritDoc
     */
    public function isSuperAdmin(int $id): bool
    {
        return $this->userDao->isSuperAdmin($id);
    }

    /**
     * @inheritDoc
     */
    public function extractCode(?string $code = null): array
    {
        if ($code) {
            foreach (config('constants.USER.ROLES.TEXT') as $roleId => $role) {
                if ($role[0] === $code[0]) {
                    $id = (int) Str::substr($code, 2);
                    return ["id" =>  $id, "role" =>  $roleId];
                }
            }
        }

        return ["id" => null, "role" => null];
    }
}
