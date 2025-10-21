<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClubMember extends Model
{
    protected $fillable = [
        'club_id',
        'student_id',
        'role',
        'joined_date',
        'responsibilities',
        'is_active',
    ];

    protected $casts = [
        'joined_date' => 'date',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $this->where('is_active', true);
    }

    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }
}
