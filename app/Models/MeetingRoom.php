<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Enums\RegionCode;

class MeetingRoom extends Model
{
    protected $fillable = [
        'name',
        'region_code',
        'capacity',
        'image',
        'is_enable',
    ];

    protected $casts = [
        'region_code' => RegionCode::class, 
        'is_enable' => 'boolean',
        'capacity' => 'integer',
    ];

    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class, 'meeting_room_facilities')
                    ->using(MeetingRoomFacility::class)
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    public function reservation(): HasMany
    {
        return $this->hasMany(MeetingRoomReservation::class);
    }
}
