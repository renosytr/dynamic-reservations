<?php

namespace App\Enums;

enum ReservationStatus: int
{
    case Pending = 1;
    case Approved = 2;
    case Finished = 3;
    case Canceled = 4;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
