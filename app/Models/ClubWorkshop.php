<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClubWorkshop extends Model
{
    protected $fillable = [
        'club_id',
        'title',
        'description',
        'instructor',
        'venue',
        'start_date',
        'end_date',
        'max_participants',
        'registration_link',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
        'max_participants' => 'integer',
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
        return $query->where('start_date', '>', now());
    }

    public function scopePast($query)
    {
        return $query->where('start_date', '<=', now());
    }
}
