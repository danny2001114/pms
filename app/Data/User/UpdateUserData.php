<?php

namespace App\Data\User;

use Spatie\LaravelData\Data;

class UpdateUserData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly ?int $role,
        public readonly string $email,
        public readonly string $phone,
        public readonly int $gender,
        public readonly ?string $address,
        public readonly ?string $birthday,
        public readonly ?string $bio,
        public readonly ?string $image
    ) {}
}
