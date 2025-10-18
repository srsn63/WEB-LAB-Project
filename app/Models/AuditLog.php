<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = [
        'actor_type',
        'actor_id',
        'actor_name',
        'action',
        'target_type',
        'target_id',
        'target_name',
        'changed_fields',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'changed_fields' => 'array',
    ];
}
