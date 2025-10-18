<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use App\Services\AuditLogger;

class AdminContactMessageController extends Controller
{
    /**
     * Display all contact messages
     */
    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Display a specific message
     */
    public function show(ContactMessage $message)
    {
        // Mark as read when viewed
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
            AuditLogger::log(request(), 'updated', 'ContactMessage', $message->id, $message->email, ['is_read' => ['before' => false, 'after' => true]]);
        }
        
        return view('admin.messages.show', compact('message'));
    }

    /**
     * Delete a message
     */
    public function destroy(ContactMessage $message)
    {
    AuditLogger::log(request(), 'deleted', 'ContactMessage', $message->id, $message->email, null);
    $message->delete();
        return redirect()->route('admin.messages.index')->with('status', 'Message deleted successfully.');
    }
}
