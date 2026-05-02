<?php

namespace App\Data\Skill;

use Spatie\LaravelData\Data;

class SkillData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $image,
        public readonly ?bool $active
    ) {}
}
