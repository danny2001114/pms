<?php

namespace App\Data\User;

use Spatie\LaravelData\Data;

class CreateUserData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $password,
        public readonly ?int $role,
        public readonly string $email,
        public readonly string $phone,
        public readonly int $gender
    ) {}
}
