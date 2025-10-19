<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'semester',
        'exam_type',
        'marks_obtained',
        'total_marks',
        'grade',
        'grade_point',
        'remarks',
    ];

    /**
     * Get the student that owns the result
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    /**
     * Get the course for this result
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get percentage
     */
    public function getPercentageAttribute()
    {
        if ($this->total_marks > 0) {
            return round(($this->marks_obtained / $this->total_marks) * 100, 2);
        }
        return 0;
    }

    /**
     * Scope for a specific student
     */
    public function scopeForStudent($query, $studentId)
    {
        return $query->where('student_id', $studentId);
    }

    /**
     * Scope for a specific semester
     */
    public function scopeForSemester($query, $semester)
    {
        return $query->where('semester', $semester);
    }

    /**
     * Get exam types
     */
    public static function getExamTypes()
    {
        return ['midterm', 'final', 'quiz', 'assignment', 'project'];
    }

    /**
     * Calculate grade from marks
     */
    public static function calculateGrade($percentage)
    {
        if ($percentage >= 80) return ['grade' => 'A+', 'point' => 4.00];
        if ($percentage >= 75) return ['grade' => 'A', 'point' => 3.75];
        if ($percentage >= 70) return ['grade' => 'A-', 'point' => 3.50];
        if ($percentage >= 65) return ['grade' => 'B+', 'point' => 3.25];
        if ($percentage >= 60) return ['grade' => 'B', 'point' => 3.00];
        if ($percentage >= 55) return ['grade' => 'B-', 'point' => 2.75];
        if ($percentage >= 50) return ['grade' => 'C+', 'point' => 2.50];
        if ($percentage >= 45) return ['grade' => 'C', 'point' => 2.25];
        if ($percentage >= 40) return ['grade' => 'D', 'point' => 2.00];
        return ['grade' => 'F', 'point' => 0.00];
    }
}
