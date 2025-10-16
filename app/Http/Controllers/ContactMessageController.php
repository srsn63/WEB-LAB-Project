<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Store a contact message from the public form
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        ContactMessage::create($validated);

        return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}
