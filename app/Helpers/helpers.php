<?php

if (!function_exists("page")) {
    function page(string $name, ?string $default = null): string
    {
        return config("pages.{$name}", $default);
    }
}
