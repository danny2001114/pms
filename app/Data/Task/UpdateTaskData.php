<?php

namespace App\Data\Task;

use Spatie\LaravelData\Data;

class UpdateTaskData extends Data
{
    public function __construct(
        public readonly string $description,
        public readonly ?string $priority,
        public readonly ?string $state,
        public readonly string $start_date,
        public readonly string $end_date
    ) {}
}
