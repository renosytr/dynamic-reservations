<?php

namespace App\Enums;

enum UserRole: int
{
    case Superuser = 1;
    case Admin = 2;
    case User = 3;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
