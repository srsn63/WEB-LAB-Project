<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditLogger
{
    public static function log(Request $request, string $action, string $targetType, $targetId = null, ?string $targetName = null, array $changed = null): void
    {
        // Determine actor (admin, teacher, guest)
        $actorType = 'guest';
        $actorId = null;
        $actorName = null;

        if (Auth::guard('admin')->check()) {
            $actorType = 'admin';
            $actorId = Auth::guard('admin')->id();
            $actorName = Auth::guard('admin')->user()->name ?? 'Admin';
        } elseif (Auth::guard('teacher')->check()) {
            $actorType = 'teacher';
            $actorId = Auth::guard('teacher')->id();
            $actorName = Auth::guard('teacher')->user()->name ?? 'Teacher';
        }

        AuditLog::create([
            'actor_type' => $actorType,
            'actor_id' => $actorId,
            'actor_name' => $actorName,
            'action' => $action,
            'target_type' => $targetType,
            'target_id' => $targetId,
            'target_name' => $targetName,
            'changed_fields' => $changed,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }
}
