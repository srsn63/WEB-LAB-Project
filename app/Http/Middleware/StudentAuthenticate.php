<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentAuthenticate
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('student')->check()) {
            return redirect()->route('student.login');
        }

        // Check if student account is active
        $student = Auth::guard('student')->user();
        if (!$student->is_active) {
            Auth::guard('student')->logout();
            return redirect()->route('student.login')
                ->withErrors(['email' => 'Your account has been deactivated. Please contact the administrator.']);
        }

        return $next($request);
    }
}
