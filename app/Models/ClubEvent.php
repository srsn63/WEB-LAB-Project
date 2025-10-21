<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClubEvent extends Model
{
    protected $fillable = [
        'club_id',
        'title',
        'description',
        'venue',
        'event_date',
        'end_date',
        'event_type',
        'registration_link',
        'is_active',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>', now());
    }

    public function scopePast($query)
    {
        return $query->where('event_date', '<=', now());
    }
}
