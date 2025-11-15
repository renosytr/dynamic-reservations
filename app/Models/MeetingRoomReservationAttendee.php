<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MeetingRoomReservationAttendee extends Model
{
    protected $fillable = [
        'meeting_room_reservation_id',
        'email',
    ];

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(MeetingRoomReservation::class);
    }
}
