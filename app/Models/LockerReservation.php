<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\ReservationStatus;

class LockerReservation extends Model
{
    protected $fillable = [
        'title',
        'locker_id',
        'user_id',
        'start',
        'end',
        'email',
        'status',
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
        'status' => ReservationStatus::class,
    ];

    public function locker(): belongsTo
    {
        return $this->belongsTo(Locker::class);
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
