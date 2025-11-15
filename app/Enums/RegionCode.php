<?php

namespace App\Enums;

enum RegionCode: int
{
    case Jakarta = 1;
    case Surabaya = 2;
    case Yogyakarta = 3;
    case Medan = 4;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
