<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::active()
            ->upcoming()
            ->paginate(9, ['*'], 'upcoming');

        $pastEvents = Event::active()
            ->past()
            ->paginate(9, ['*'], 'past');

        $featuredEvents = Event::active()
            ->featured()
            ->upcoming()
            ->take(3)
            ->get();

        return view('events.index', compact('upcomingEvents', 'pastEvents', 'featuredEvents'));
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }
}
