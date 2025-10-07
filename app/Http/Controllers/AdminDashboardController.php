<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    /**
     * Render the admin dashboard with a quick teacher overview.
     */
    public function index(Request $request): View
    {
        $admin = Admin::findOrFail($request->session()->get('admin_id'));
        $recentTeachers = Teacher::orderByDesc('created_at')->take(5)->get();

        return view('admin.dashboard', [
            'admin' => $admin,
            'recentTeachers' => $recentTeachers,
        ]);
    }
}
