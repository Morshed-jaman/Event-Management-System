<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    public function index(Request $request)
    {
        $query = Venue::query();

        if ($request->has('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        $venues = $query->get();

        return view('venues.index', compact('venues'));
    }

    public function create()
    {
        // Ensure only admin can create a venue
        if (auth()->user()->is_admin) {
            return view('venues.create');
        }

        return redirect()->route('venues.index')->with('error', 'You do not have permission to create a venue.');
    }

    public function store(Request $request)
    {
        // Validate the venue data
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'capacity' => 'required|integer',
        ]);

        Venue::create($request->all());

        return redirect()->route('venues.index')->with('success', 'Venue created successfully!');
    }

    public function show($id)
    {
        $venue = Venue::with('events')->findOrFail($id);
        return view('venues.show', compact('venue'));
    }

    public function edit($id)
    {   
        // Ensure only admin can edit a venue
        $venue = Venue::findOrFail($id);

        if (auth()->user()->is_admin) {
            return view('venues.edit', compact('venue'));
        }

        return redirect()->route('venues.index')->with('error', 'You do not have permission to edit this venue.');
    }

    public function update(Request $request, $id)
    {
        $venue = Venue::findOrFail($id);

        // Validate the venue data
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'capacity' => 'required|integer',
        ]);

        // Ensure only admin can update the venue
        if (auth()->user()->is_admin) {
            $venue->update($request->all());
            return redirect()->route('venues.index')->with('success', 'Venue updated!');
        }

        return redirect()->route('venues.index')->with('error', 'You do not have permission to update this venue.');
    }

    public function destroy($id)
    {
        // Ensure only admin can delete the venue
        if (auth()->user()->is_admin) {
            Venue::destroy($id);
            return redirect()->route('venues.index')->with('success', 'Venue deleted!');
        }

        return redirect()->route('venues.index')->with('error', 'You do not have permission to delete this venue.');
    }
}
