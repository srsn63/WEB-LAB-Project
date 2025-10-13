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
        'is_head',
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
     * Scope a query to order teachers by head first, then by designation priority, then name.
     */
    public function scopeOrdered($query)
    {
        $order = [
            'Head' => 0,
            'Professor' => 1,
            'Associate Professor' => 2,
            'Assistant Professor' => 3,
            'Lecturer' => 4,
        ];

        return $query->orderByDesc('is_head')
            ->orderByRaw("CASE\n" .
                implode("\n", array_map(function ($k, $v) { return "WHEN designation = '".$k."' THEN $v"; }, array_keys($order), $order)) .
                "\nELSE 999 END")
            ->orderBy('name');
    }

    /**
     * Resolve route-model binding via IDs (default behavior).
     */
    public function getRouteKeyName(): string
    {
        return 'id';
    }
}
