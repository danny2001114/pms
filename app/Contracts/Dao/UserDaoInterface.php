<?php

namespace App\Contracts\Dao;

use App\Models\User;

interface UserDaoInterface
{
    public function getByAttribute(string $attribute, mixed $value): User;
}
