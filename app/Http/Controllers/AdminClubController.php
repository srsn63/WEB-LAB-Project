<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\ClubMember;
use App\Models\ClubWorkshop;
use App\Models\ClubEvent;
use App\Models\Student;
use App\Services\AuditLogger;
use Illuminate\Http\Request;

class AdminClubController extends Controller
{
    public function index()
    {
        $clubs = Club::withCount('members')
            ->orderBy('order')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.clubs.index', compact('clubs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'short_name' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string'],
            'mission' => ['nullable', 'string'],
            'vision' => ['nullable', 'string'],
            'email' => ['nullable', 'email', 'max:255'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'founded_date' => ['nullable', 'date'],
            'is_active' => ['boolean'],
            'order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $club = Club::create($validated);

        AuditLogger::log(
            $request,
            'club_created',
            'Club',
            $club->id,
            "Created club: {$club->name}",
            $validated
        );

        return redirect()->route('admin.clubs.index')
            ->with('status', "Club '{$club->name}' created successfully!");
    }

    public function edit(Club $club)
    {
        return view('admin.clubs.edit', compact('club'));
    }

    public function update(Request $request, Club $club)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'short_name' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string'],
            'mission' => ['nullable', 'string'],
            'vision' => ['nullable', 'string'],
            'email' => ['nullable', 'email', 'max:255'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'founded_date' => ['nullable', 'date'],
            'is_active' => ['boolean'],
            'order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $oldData = $club->toArray();

        $club->update($validated);

        // Track changes
        $changes = [];
        foreach ($validated as $key => $value) {
            if (isset($oldData[$key]) && $oldData[$key] != $value) {
                $changes[$key] = ['old' => $oldData[$key], 'new' => $value];
            }
        }

        if (!empty($changes)) {
            AuditLogger::log(
                $request,
                'club_updated',
                'Club',
                $club->id,
                "Updated club: {$club->name}",
                $changes
            );
        }

        return redirect()->route('admin.clubs.index')
            ->with('status', "Club '{$club->name}' updated successfully!");
    }

    public function destroy(Request $request, Club $club)
    {
        $clubName = $club->name;
        $clubId = $club->id;

        AuditLogger::log(
            $request,
            'club_deleted',
            'Club',
            $clubId,
            "Deleted club: {$clubName}",
            $club->toArray()
        );

        $club->delete();

        return redirect()->route('admin.clubs.index')
            ->with('status', "Club '{$clubName}' deleted successfully!");
    }

    // Manage club members
    public function members(Club $club)
    {
        $club->load(['members.student']);
        
        // Get all students for dropdown
        $students = Student::select('id', 'name', 'student_id', 'batch')
            ->orderBy('batch', 'desc')
            ->orderBy('name')
            ->get();

        // Define common roles
        $roles = [
            'President',
            'Vice President',
            'General Secretary',
            'Secretary',
            'Treasurer',
            'Executive Member',
            'Member',
        ];

        return view('admin.clubs.members', compact('club', 'students', 'roles'));
    }

    // Add member to club
    public function addMember(Request $request, Club $club)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'role' => ['required', 'string', 'max:100'],
            'joined_date' => ['required', 'date'],
            'responsibilities' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        // Check if student already a member
        $exists = $club->members()
            ->where('student_id', $validated['student_id'])
            ->exists();

        if ($exists) {
            return back()->with('error', 'This student is already a member of this club!');
        }

        // Check if trying to assign President role
        if ($validated['role'] === 'President') {
            $existingPresident = $club->members()
                ->where('role', 'President')
                ->first();

            if ($existingPresident) {
                return back()->with('error', "Cannot assign President role. {$existingPresident->student->name} is already the President. Please change their role first.");
            }
        }

        $member = $club->members()->create($validated);

        $student = Student::find($validated['student_id']);

        AuditLogger::log(
            $request,
            'club_member_added',
            'Club',
            $club->id,
            "Added {$student->name} as {$validated['role']} to club {$club->name}",
            $validated
        );

        return back()->with('status', "{$student->name} added to club successfully!");
    }

    // Remove member from club
    public function removeMember(Request $request, Club $club, ClubMember $member)
    {
        $studentName = $member->student->name;

        AuditLogger::log(
            $request,
            'club_member_removed',
            'Club',
            $club->id,
            "Removed {$studentName} from club {$club->name}",
            $member->toArray()
        );

        $member->delete();

        return back()->with('status', "{$studentName} removed from club successfully!");
    }

    // Update member role
    public function updateMember(Request $request, Club $club, ClubMember $member)
    {
        $validated = $request->validate([
            'role' => ['required', 'string', 'max:100'],
            'responsibilities' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        // Check if trying to assign President role
        if ($validated['role'] === 'President') {
            // Check if another member is already President
            $existingPresident = $club->members()
                ->where('role', 'President')
                ->where('id', '!=', $member->id)
                ->first();

            if ($existingPresident) {
                return back()->with('error', "Cannot assign President role. {$existingPresident->student->name} is already the President. Please change their role first.");
            }
        }

        $oldData = $member->toArray();
        $member->update($validated);

        AuditLogger::log(
            $request,
            'club_member_updated',
            'Club',
            $club->id,
            "Updated {$member->student->name}'s role in club {$club->name}",
            ['old' => $oldData, 'new' => $validated]
        );

        return back()->with('status', 'Member information updated successfully!');
    }

    // Workshops Management
    public function workshops(Club $club)
    {
        $club->load('workshops');
        return view('admin.clubs.workshops', compact('club'));
    }

    public function storeWorkshop(Request $request, Club $club)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'instructor' => ['nullable', 'string', 'max:255'],
            'venue' => ['nullable', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after:start_date'],
            'max_participants' => ['nullable', 'integer', 'min:1'],
            'registration_link' => ['nullable', 'url', 'max:255'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['club_id'] = $club->id;

        $workshop = $club->workshops()->create($validated);

        AuditLogger::log(
            $request,
            'workshop_created',
            'Club',
            $club->id,
            "Created workshop '{$workshop->title}' for club {$club->name}",
            $validated
        );

        return back()->with('status', 'Workshop added successfully!');
    }

    public function updateWorkshop(Request $request, Club $club, $workshop)
    {
        $workshop = $club->workshops()->findOrFail($workshop);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'instructor' => ['nullable', 'string', 'max:255'],
            'venue' => ['nullable', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after:start_date'],
            'max_participants' => ['nullable', 'integer', 'min:1'],
            'registration_link' => ['nullable', 'url', 'max:255'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        $oldData = $workshop->toArray();
        $workshop->update($validated);

        AuditLogger::log(
            $request,
            'workshop_updated',
            'Club',
            $club->id,
            "Updated workshop '{$workshop->title}' for club {$club->name}",
            ['old' => $oldData, 'new' => $validated]
        );

        return back()->with('status', 'Workshop updated successfully!');
    }

    public function destroyWorkshop(Request $request, Club $club, $workshop)
    {
        $workshop = $club->workshops()->findOrFail($workshop);
        $workshopTitle = $workshop->title;

        AuditLogger::log(
            $request,
            'workshop_deleted',
            'Club',
            $club->id,
            "Deleted workshop '{$workshopTitle}' from club {$club->name}",
            $workshop->toArray()
        );

        $workshop->delete();

        return back()->with('status', 'Workshop deleted successfully!');
    }

    // Events Management
    public function events(Club $club)
    {
        $club->load('events');
        return view('admin.clubs.events', compact('club'));
    }

    public function storeEvent(Request $request, Club $club)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'venue' => ['nullable', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after:event_date'],
            'event_type' => ['nullable', 'string', 'max:100'],
            'registration_link' => ['nullable', 'url', 'max:255'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['club_id'] = $club->id;

        $event = $club->events()->create($validated);

        AuditLogger::log(
            $request,
            'event_created',
            'Club',
            $club->id,
            "Created event '{$event->title}' for club {$club->name}",
            $validated
        );

        return back()->with('status', 'Event added successfully!');
    }

    public function updateEvent(Request $request, Club $club, $event)
    {
        $event = $club->events()->findOrFail($event);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'venue' => ['nullable', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after:event_date'],
            'event_type' => ['nullable', 'string', 'max:100'],
            'registration_link' => ['nullable', 'url', 'max:255'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        $oldData = $event->toArray();
        $event->update($validated);

        AuditLogger::log(
            $request,
            'event_updated',
            'Club',
            $club->id,
            "Updated event '{$event->title}' for club {$club->name}",
            ['old' => $oldData, 'new' => $validated]
        );

        return back()->with('status', 'Event updated successfully!');
    }

    public function destroyEvent(Request $request, Club $club, $event)
    {
        $event = $club->events()->findOrFail($event);
        $eventTitle = $event->title;

        AuditLogger::log(
            $request,
            'event_deleted',
            'Club',
            $club->id,
            "Deleted event '{$eventTitle}' from club {$club->name}",
            $event->toArray()
        );

        $event->delete();

        return back()->with('status', 'Event deleted successfully!');
    }
}
