<?php

namespace App\Contracts\Services;

use App\Models\User;

interface UserServiceInterface
{
    public function getByAttribute(string $attribute, mixed $value): User;
}
