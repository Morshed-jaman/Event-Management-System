<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendeeController extends Controller
{
    // Register an attendee for an event
    public function register($eventId)
    {
        $event = Event::findOrFail($eventId);

        // Check if the user is already registered for this event
        if (Auth::user()->events()->where('event_id', $eventId)->exists()) {
            return redirect()->route('events.show', $eventId)->with('error', 'You are already registered for this event.');
        }

        // Attach the user to the event (register for the event)
        Auth::user()->events()->attach($event);

        return redirect()->route('attendees.myEvents')->with('success', 'You have successfully registered for the event.');
    }

    // View all registered events for the logged-in user
    public function myEvents()
    {
        $user = Auth::user();
        $events = $user->events; // Get events the user is registered for

        return view('attendees.index', compact('events'));
    }

    // Unregister an attendee from an event
    public function unregister($eventId)
    {
        $event = Event::findOrFail($eventId);

        // Detach the user from the event (unregister)
        Auth::user()->events()->detach($event);

        return redirect()->route('attendees.myEvents')->with('success', 'You have successfully unregistered from the event.');
    }
}
