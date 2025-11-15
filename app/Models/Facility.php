<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Facility extends Model
{
    protected $fillable = [
        'name',
        'icon',
    ];

    public function meetingRooms(): BelongsToMany
    {
        return $this->belongsToMany(MeetingRoom::class, 'meeting_room_facilities')
            ->using(MeetingRoomFacility::class) 
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function lockers(): BelongsToMany
    {
        return $this->belongsToMany(Locker::class, 'locker_facilities')
            ->using(LockerFacility::class) 
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
