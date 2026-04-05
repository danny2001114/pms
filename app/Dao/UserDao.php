<?php

namespace App\Dao;

use App\Contracts\Dao\UserDaoInterface;
use App\Models\User;

class UserDao implements UserDaoInterface
{
    public function __construct(
        protected User $user
    )
    {}

    public function getByAttribute(string $attribute, mixed $value): User
    {
        return $this->user::where($attribute, $value)
                          ->first();
    }
}
