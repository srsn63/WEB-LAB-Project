<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerOpportunity extends Model
{
    protected $fillable = [
        'title',
        'company_name',
        'job_type',
        'description',
        'requirements',
        'location',
        'salary_range',
        'deadline',
        'application_link',
        'contact_email',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'deadline' => 'date',
    ];

    /**
     * Scope to get active opportunities only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to filter by job type
     */
    public function scopeJobType($query, $type)
    {
        return $query->where('job_type', $type);
    }

    /**
     * Get available job types
     */
    public static function getJobTypes()
    {
        return [
            'internship' => 'Internship',
            'full-time' => 'Full-Time',
            'part-time' => 'Part-Time',
        ];
    }
}
