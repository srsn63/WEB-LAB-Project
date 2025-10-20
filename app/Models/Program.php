<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'name',
        'short_name',
        'degree_type',
        'duration',
        'total_credits',
        'description',
        'objectives',
        'career_prospects',
        'admission_requirements',
        'program_coordinator_id',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'total_credits' => 'integer',
        'order' => 'integer',
    ];

    // Relationships
    public function coordinator()
    {
        return $this->belongsTo(Teacher::class, 'program_coordinator_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'program_courses')
            ->withPivot('year', 'semester', 'is_mandatory')
            ->withTimestamps()
            ->orderBy('year')
            ->orderBy('semester');
    }

    public function programCourses()
    {
        return $this->hasMany(ProgramCourse::class);
    }

    public function outcomes()
    {
        return $this->hasMany(ProgramOutcome::class)->orderBy('order');
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByDegreeType($query, $type)
    {
        return $query->where('degree_type', $type);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name');
    }

    // Helper methods
    public function getCoursesByYearSemester($year, $semester)
    {
        return $this->courses()
            ->wherePivot('year', $year)
            ->wherePivot('semester', $semester)
            ->get();
    }

    public function getTotalCreditsByYear($year)
    {
        return $this->courses()
            ->wherePivot('year', $year)
            ->sum('credits');
    }

    public function getMandatoryCourses()
    {
        return $this->courses()->wherePivot('is_mandatory', true)->get();
    }

    public function getElectiveCourses()
    {
        return $this->courses()->wherePivot('is_mandatory', false)->get();
    }
}
