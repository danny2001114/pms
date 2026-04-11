<?php

namespace App\Data\Project;

use Spatie\LaravelData\Data;

class UpdateProjectData extends Data
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly ?int $owner_id,
        public readonly ?int $state,
        public readonly ?bool $active,
        public readonly ?int $type_id,
        public readonly ?bool $is_client,
        public readonly string $start_date,
        public readonly string $end_date,
    ) {}
}
