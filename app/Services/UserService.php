<?php

namespace App\Services;

use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Models\User;

class UserService implements UserServiceInterface
{
    public function __construct(
        protected UserDaoInterface $userDao
    )
    {}

    public function getByAttribute(string $attribute, mixed $value): User
    {
        return $this->userDao->getByAttribute($attribute, $value);
    }
}
