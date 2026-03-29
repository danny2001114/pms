<?php

namespace App\Dto;

use ReflectionClass;

class BaseDto
{
    public function __construct(...$params)
    {}

    public static function pack(array $data): array
    {
        $reflection = new ReflectionClass(static::class);
        $params = $reflection->getConstructor()->getParameters();

        $stacks = [];

        foreach ($params as $param) {
            $name = $param->getName();
            $stacks[] = $data[$name] ?? null;
        }

        return get_object_vars(new static(...$stacks));
    }
}
