<?php

namespace App\Models;

use App\Enums\RegionCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Locker extends Model
{
    protected $fillable = [
        'name',
        'region_code',
        'capacityLength',
        'capacityWidth',
        'capacityDepth',
        'image',
        'is_enable',
    ];

    protected $casts = [
        'region_code' => RegionCode::class, 
        'is_enable' => 'boolean',
        'capacityLength' => 'integer',
        'capacityWidth' => 'integer',
        'capacityDepth' => 'integer',
    ];

    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class, 'locker_facilities')
                    ->using(LockerFacility::class)
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    public function reservation(): HasMany
    {
        return $this->hasMany(LockerReservation::class);
    }
}
