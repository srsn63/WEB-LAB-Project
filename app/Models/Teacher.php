<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /**
     * Mass assignable attributes for teacher profiles.
     */
    protected $fillable = [
        'name',
        'slug',
        'designation',
        'department',
        'availability_status',
        'email',
        'phone',
        'office_room',
        'website_url',
        'profile_image',
        'short_bio',
        'research_interests',
        'education',
        'honors',
        'courses',
        'publications',
    ];

    /**
     * Attribute casting for structured teacher data.
     */
    protected $casts = [
        'education' => 'array',
        'honors' => 'array',
        'courses' => 'array',
    ];

    /**
     * Resolve route-model binding via unique slugs.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
