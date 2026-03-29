<?php

namespace App\Dto\ProjectType;

use App\Dto\BaseDto;

class ProjectTypeDto extends BaseDto
{
    public function __construct(
        public readonly string $label,
        public readonly ?string $remark,
        public readonly ?bool $active
    )
    {}
}
