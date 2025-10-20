<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramOutcome extends Model
{
    protected $fillable = [
        'program_id',
        'outcome_text',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    // Relationship
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
