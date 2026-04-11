<?php

namespace App\Data\Project;

use Spatie\LaravelData\Data;

class CreateProjectData extends Data
{
    public function __construct(
        public readonly string $code,
        public readonly string $title,
        public readonly int $owner_id,
        public readonly string $description,
        public readonly int $created_by,
        public readonly ?int $state,
        public readonly ?bool $active,
        public readonly ?int $type_id,
        public readonly ?int $priority,
        public readonly string $start_date,
        public readonly string $end_date
    ) {}
}
