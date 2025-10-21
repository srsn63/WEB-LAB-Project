<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'event_type',
        'venue',
        'event_date',
        'end_date',
        'organizer',
        'contact_email',
        'registration_link',
        'banner_image',
        'max_participants',
        'is_featured',
        'is_active',
        'order'
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'end_date' => 'datetime',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'max_participants' => 'integer',
        'order' => 'integer'
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>', now())
                    ->orderBy('event_date', 'asc');
    }

    public function scopePast($query)
    {
        return $query->where('event_date', '<', now())
                    ->orderBy('event_date', 'desc');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')
                    ->orderBy('event_date', 'asc');
    }

    // Helper methods
    public function isUpcoming()
    {
        return $this->event_date > now();
    }

    public function isPast()
    {
        return $this->event_date < now();
    }

    public function isOngoing()
    {
        if (!$this->end_date) {
            return false;
        }
        return now()->between($this->event_date, $this->end_date);
    }

    public function getFormattedDateAttribute()
    {
        return $this->event_date->format('F j, Y');
    }

    public function getFormattedTimeAttribute()
    {
        return $this->event_date->format('g:i A');
    }

    public function getFormattedDateTimeAttribute()
    {
        return $this->event_date->format('F j, Y \a\t g:i A');
    }

    public function getDurationAttribute()
    {
        if (!$this->end_date) {
            return null;
        }
        return $this->event_date->diffForHumans($this->end_date, true);
    }

    public function getStatusAttribute()
    {
        if ($this->isOngoing()) {
            return 'ongoing';
        } elseif ($this->isUpcoming()) {
            return 'upcoming';
        } else {
            return 'past';
        }
    }

    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'ongoing' => 'bg-success',
            'upcoming' => 'bg-primary',
            'past' => 'bg-secondary',
            default => 'bg-secondary'
        };
    }
}
