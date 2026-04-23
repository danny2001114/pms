<?php

namespace App\Data\User;

use Spatie\LaravelData\Data;

/**
 * Data transfer object for creating user
 */
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
