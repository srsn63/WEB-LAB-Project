<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('event_date', 'desc')->paginate(15);
        $upcomingCount = Event::active()->upcoming()->count();
        $pastCount = Event::active()->past()->count();
        $featuredCount = Event::active()->featured()->count();
        
        return view('admin.events.index', compact('events', 'upcomingCount', 'pastCount', 'featuredCount'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_type' => 'nullable|string|max:255',
            'venue' => 'nullable|string|max:255',
            'event_date' => 'required|date',
            'end_date' => 'nullable|date|after:event_date',
            'organizer' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'registration_link' => 'nullable|url|max:500',
            'banner_image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'max_participants' => 'nullable|integer|min:1',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'nullable|integer'
        ]);

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $request->file('banner_image')->store('events', 'public');
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        $event = Event::create($validated);

        // Audit log
        AuditLog::create([
            'actor_type' => 'Admin',
            'actor_id' => auth()->id(),
            'actor_name' => auth()->user()->name ?? 'Admin',
            'action' => 'create',
            'target_type' => 'Event',
            'target_id' => $event->id,
            'target_name' => $event->title,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        // Clear cache
        Cache::forget('homepage_events');

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully!');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_type' => 'nullable|string|max:255',
            'venue' => 'nullable|string|max:255',
            'event_date' => 'required|date',
            'end_date' => 'nullable|date|after:event_date',
            'organizer' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'registration_link' => 'nullable|url|max:500',
            'banner_image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'max_participants' => 'nullable|integer|min:1',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'nullable|integer'
        ]);

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            // Delete old image
            if ($event->banner_image) {
                Storage::disk('public')->delete($event->banner_image);
            }
            $validated['banner_image'] = $request->file('banner_image')->store('events', 'public');
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        $event->update($validated);

        // Audit log
        AuditLog::create([
            'actor_type' => 'Admin',
            'actor_id' => auth()->id(),
            'actor_name' => auth()->user()->name ?? 'Admin',
            'action' => 'update',
            'target_type' => 'Event',
            'target_id' => $event->id,
            'target_name' => $event->title,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        // Clear cache
        Cache::forget('homepage_events');

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        $title = $event->title;
        
        // Delete banner image
        if ($event->banner_image) {
            Storage::disk('public')->delete($event->banner_image);
        }

        $event->delete();

        // Audit log
        AuditLog::create([
            'actor_type' => 'Admin',
            'actor_id' => auth()->id(),
            'actor_name' => auth()->user()->name ?? 'Admin',
            'action' => 'delete',
            'target_type' => 'Event',
            'target_id' => $event->id,
            'target_name' => $title,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        // Clear cache
        Cache::forget('homepage_events');

        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted successfully!');
    }
}
