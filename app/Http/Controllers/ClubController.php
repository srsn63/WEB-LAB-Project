<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function index()
    {
        $clubs = Club::active()
            ->withCount('activeMembers')
            ->ordered()
            ->get();

        return view('clubs.index', compact('clubs'));
    }

    public function show(Club $club)
    {
        $club->load(['activeMembers.student' => function($query) {
            $query->select('id', 'name', 'student_id', 'batch', 'email');
        }]);

        // Get executive members
        $executives = $club->getExecutiveMembers();

        // Get regular members
        $regularMembers = $club->activeMembers()
            ->whereNotIn('role', ['President', 'Vice President', 'Secretary', 'Treasurer'])
            ->with('student')
            ->get();

        // Get workshops and events
        $workshops = $club->activeWorkshops()->orderBy('start_date', 'desc')->get();
        $events = $club->activeEvents()->orderBy('event_date', 'desc')->get();

        return view('clubs.show', compact('club', 'executives', 'regularMembers', 'workshops', 'events'));
    }
}
