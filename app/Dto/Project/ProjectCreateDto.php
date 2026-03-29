<?php

namespace App\Dto\Project;

use App\Dto\BaseDto;

class ProjectCreateDto extends BaseDto
{
    public function __construct(
        public readonly string $code,
        public readonly string $order,
        public readonly string $title,
        public readonly string $description,
        public readonly int $owner,
        public readonly ?int $recipient,
        public readonly ?int $state,
        public readonly ?bool $active,
        public readonly ?int $type,
        public readonly ?bool $is_client,
        public readonly ?string $start_date,
        public readonly ?string $end_date
    )
    {}
}
