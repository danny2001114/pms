<?php

namespace App\Data\ProjectType;

use Spatie\LaravelData\Data;

class ProjectTypeData extends Data
{
    public function __construct(
        public readonly string $label,
        public readonly ?string $remark,
        public readonly ?bool $active
    ) {}
}
