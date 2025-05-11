<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Venue;
use Illuminate\Http\Request;
use Carbon\Carbon; // For date manipulation
use App\Notifications\EventUpdatedNotification; // Import the notification


class EventController extends Controller
{
    /**
     * Display a listing of the events.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Event::with('venue');

        if ($request->has('location') && $request->location !== '') {
            $query->whereHas('venue', function ($q) use ($request) {
               $q->where('location', 'like', '%' . $request->location . '%');
            });
        }

        $events = $query->get();

        // stats
        $upcomingEventsCount = Event::where('start_date', '>=', Carbon::now())->count();
        $pastEventsCount = Event::where('end_date', '<', Carbon::now())->count();

        return view('dashboard', compact('events', 'upcomingEventsCount', 'pastEventsCount'));
    }

    /**
     * Show the form for creating a new event.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $venues = Venue::all(); // Get all venues
        return view('events.create', compact('venues'));
    }

    /**
     * Store a newly created event in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the event data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'venue_id' => 'nullable|exists:venues,id',
        ]);

        // Create the event and store it in the database
        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'venue_id' => $request->venue_id,
        ]);

        return redirect()->route('dashboard')->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $venues = Venue::all();

        if (auth()->user()->is_admin) {
            return view('events.edit', compact('event', 'venues'));
        }

        return redirect()->route('dashboard')->with('error', 'You do not have permission to edit this event.');
    }

    /**
     * Update the specified event in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        if (auth()->user()->is_admin) {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'venue_id' => 'required|exists:venues,id',
            ]);

            $event->update([
                'title' => $request->title,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'venue_id' => $request->venue_id,
            ]);

            // Notify all attendees about the event update
            foreach ($event->users as $user) {
            $user->notify(new EventUpdatedNotification($event));
            }

            return redirect()->route('dashboard')->with('success', 'Event updated successfully!');
        }

        return redirect()->route('dashboard')->with('error', 'You do not have permission to update this event.');
    }

    /**
     * Remove the specified event from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if (auth()->user()->is_admin) {
            $event->delete();
            return redirect()->route('dashboard')->with('success', 'Event deleted successfully!');
        }

        return redirect()->route('dashboard')->with('error', 'You do not have permission to delete this event.');
    }
}
