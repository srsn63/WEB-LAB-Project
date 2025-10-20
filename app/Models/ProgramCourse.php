<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramCourse extends Model
{
    protected $fillable = [
        'program_id',
        'course_id',
        'year',
        'semester',
        'is_mandatory',
    ];

    protected $casts = [
        'is_mandatory' => 'boolean',
        'year' => 'integer',
        'semester' => 'integer',
    ];

    // Relationships
    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Helper method to get semester string (e.g., "1-1", "2-2")
    public function getSemesterStringAttribute()
    {
        return "{$this->year}-{$this->semester}";
    }

    // Scope for filtering by year and semester
    public function scopeByYearSemester($query, $year, $semester)
    {
        return $query->where('year', $year)->where('semester', $semester);
    }
}
