<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    /**
     * Display the admin login screen.
     */
    public function showLoginForm(Request $request): View
    {
        if ($request->session()->has('admin_id')) {
            return view('admin.login')->with([
                'alreadyAuthenticated' => true,
            ]);
        }

        return view('admin.login');
    }

    /**
     * Attempt to authenticate the admin credentials.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'regex:/^[\w\.\-]+@admin\.gmail\.com$/'],
            'password' => ['required', 'string'],
        ], [
            'email.regex' => 'Only admin emails (@admin.gmail.com) are allowed.',
        ]);

        $admin = Admin::where('email', $credentials['email'])->first();

        if (! $admin || ! Hash::check($credentials['password'], $admin->password)) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials are incorrect.',
            ]);
        }

        $request->session()->regenerate();
        $request->session()->put('admin_id', $admin->id);

        return redirect()->route('admin.dashboard');
    }

    /**
     * Log the admin out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('admin_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('admin.login.form')
            ->with('status', 'You have been signed out successfully.');
    }
}
