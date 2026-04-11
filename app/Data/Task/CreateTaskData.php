<?php

namespace App\Data\Task;

use Spatie\LaravelData\Data;

class CreateTaskData extends Data
{
    public function __construct(
        public readonly string $code,
        public readonly int $project_id,
        public readonly string $description,
        public readonly ?string $priority,
        public readonly string $start_date,
        public readonly string $end_date
    ) {}
}
