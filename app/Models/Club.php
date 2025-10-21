<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $fillable = [
        'name',
        'short_name',
        'description',
        'mission',
        'vision',
        'logo',
        'email',
        'facebook_url',
        'website_url',
        'founded_date',
        'is_active',
        'order',
    ];

    protected $casts = [
        'founded_date' => 'date',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    // Relationships
    public function members()
    {
        return $this->hasMany(ClubMember::class);
    }

    public function activeMembers()
    {
        return $this->hasMany(ClubMember::class)->where('is_active', true);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'club_members')
            ->withPivot('role', 'joined_date', 'responsibilities', 'is_active')
            ->withTimestamps();
    }

    public function workshops()
    {
        return $this->hasMany(ClubWorkshop::class);
    }

    public function activeWorkshops()
    {
        return $this->hasMany(ClubWorkshop::class)->where('is_active', true);
    }

    public function events()
    {
        return $this->hasMany(ClubEvent::class);
    }

    public function activeEvents()
    {
        return $this->hasMany(ClubEvent::class)->where('is_active', true);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name');
    }

    // Helper methods
    public function getTotalMembersCount()
    {
        return $this->members()->count();
    }

    public function getActiveMembersCount()
    {
        return $this->activeMembers()->count();
    }

    public function getExecutiveMembers()
    {
        return $this->activeMembers()
            ->whereIn('role', ['President', 'Vice President', 'Secretary', 'Treasurer'])
            ->orderByRaw("FIELD(role, 'President', 'Vice President', 'Secretary', 'Treasurer')")
            ->get();
    }
}
