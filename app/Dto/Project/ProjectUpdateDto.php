<?php

namespace App\Dto\Project;

use App\Dto\BaseDto;

class ProjectUpdateDto extends BaseDto
{
    public function __construct(
        public readonly string $order,
        public readonly string $title,
        public readonly string $description,
        public readonly ?int $recipient,
        public readonly ?int $state,
        public readonly ?bool $active,
        public readonly ?int $type,
        public readonly ?bool $is_client,
        public readonly ?string $start_date,
        public readonly ?string $end_date,
    ){}
}
