<?php

namespace App\Data\Team;

use Spatie\LaravelData\Data;

class UpdateTeamData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly int $leader_id,
        public readonly ?string $image,
        public readonly ?string $description
    ) {}
}
