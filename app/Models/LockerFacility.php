<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LockerFacility extends Pivot
{
    protected $fillable = ['quantity'];

    public function locker(): BelongsTo
    {
        return $this->belongsTo(Locker::class);
    }

    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }
}
