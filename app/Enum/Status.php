<?php

namespace App\Enum;

enum Status: string
{
    case Active = 'active';
    case Inactive = 'inactive';
    public static function values(): array
    {
        return array_map(fn($s) => $s->value, self::cases());
    }
}
