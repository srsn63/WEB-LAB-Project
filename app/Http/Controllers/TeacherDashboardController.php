<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $teacher = Auth::guard('teacher')->user();
        return view('teacher.dashboard', compact('teacher'));
    }

    public function updateProfile(Request $request)
    {
        $teacher = Auth::guard('teacher')->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|regex:/^[\w\.\-]+@teachers\.gmail\.com$/|unique:teachers,email,' . $teacher->id,
            'phone' => 'nullable|string|max:20',
            'office_room' => 'nullable|string|max:255',
            'website_url' => 'nullable|url',
            'profile_image' => 'nullable|url',
            'short_bio' => 'nullable|string',
            'research_interests' => 'nullable|string',
            'education' => 'nullable|string',
            'honors' => 'nullable|string',
            'courses' => 'nullable|string',
            'publications' => 'nullable|string',
        ], [
            'email.regex' => 'Email must be in the format: username@teachers.gmail.com',
        ]);

        // Convert newline-separated strings to arrays
        if (isset($validated['education']) && $validated['education']) {
            $validated['education'] = array_filter(explode("\n", trim($validated['education'])));
        }
        if (isset($validated['honors']) && $validated['honors']) {
            $validated['honors'] = array_filter(explode("\n", trim($validated['honors'])));
        }
        if (isset($validated['courses']) && $validated['courses']) {
            $validated['courses'] = array_filter(explode("\n", trim($validated['courses'])));
        }

        $teacher->update($validated);

        return back()->with('success', 'Profile updated successfully!');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $teacher = Auth::guard('teacher')->user();

        if (!Hash::check($request->current_password, $teacher->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $teacher->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password changed successfully!');
    }
}
