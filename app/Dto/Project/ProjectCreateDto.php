<?php

namespace App\Dto\Project;

use App\Dto\BaseDto;

class ProjectCreateDto extends BaseDto
{
    public function __construct(
        public readonly string $code,
        public readonly string $order,
        public readonly string $title,
        public readonly int $owner_id,
        public readonly string $description,
        public readonly int $created_by,
        public readonly ?int $state,
        public readonly ?bool $active,
        public readonly ?int $type_id,
        public readonly ?int $priority,
        public readonly ?string $start_date,
        public readonly ?string $end_date
    )
    {}
}
