<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Services\AuditLogger;

class StudentAuthController extends Controller
{
    /**
     * Show student login form
     */
    public function showLoginForm()
    {
        return view('student.login');
    }

    /**
     * Handle student login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'regex:/@stud\.kuet\.ac\.bd$/'],
            'password' => 'required',
        ], [
            'email.regex' => 'Email must be in format: studentid@stud.kuet.ac.bd',
        ]);

        // Check if student exists and is active
        $student = \App\Models\Student::where('email', $credentials['email'])->first();
        
        if ($student && !$student->is_active) {
            return back()->withErrors([
                'email' => 'Your account has been deactivated. Please contact the administrator.',
            ])->onlyInput('email');
        }

        if (Auth::guard('student')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            // Log successful login
            Log::info('Student logged in', [
                'student_id' => Auth::guard('student')->user()->student_id,
                'name' => Auth::guard('student')->user()->name,
            ]);
            
            return redirect()->intended(route('student.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle student logout
     */
    public function logout(Request $request)
    {
        $studentId = Auth::guard('student')->user()->student_id;
        $studentName = Auth::guard('student')->user()->name;
        
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        Log::info('Student logged out', [
            'student_id' => $studentId,
            'name' => $studentName,
        ]);
        
        return redirect()->route('student.login')->with('success', 'You have been logged out successfully.');
    }
}
