<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\View\View;

class AdminAuditLogController extends Controller
{
    /**
     * Display a paginated list of audit logs.
     */
    public function index(): View
    {
        $logs = AuditLog::orderByDesc('created_at')->paginate(25);
        return view('admin.audit.index', compact('logs'));
    }
}
