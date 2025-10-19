<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicResource extends Model
{
    protected $fillable = [
        'title',
        'category',
        'description',
        'file_url',
        'external_link',
        'course_code',
        'semester',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope to get active resources only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to filter by category
     */
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}
