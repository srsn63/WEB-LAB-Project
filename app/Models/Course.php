<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'semester',
        'course_code',
        'course_name',
        'credits',
        'description',
    ];

    /**
     * Get all available semesters
     */
    public static function getSemesters()
    {
        return ['1-1', '1-2', '2-1', '2-2', '3-1', '3-2', '4-1', '4-2'];
    }

    /**
     * Scope a query to only include courses of a specific semester
     */
    public function scopeForSemester($query, $semester)
    {
        return $query->where('semester', $semester);
    }
}
