<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Manage Venues Button -->
            <div class="flex justify-end">
                <a href="{{ route('venues.index') }}" class="px-4 py-2 mb-4 text-white bg-indigo-600 rounded-md">
                    Manage Venues
                </a>
            </div>

            <!-- My Events Button (Newly added) -->
            <div class="flex justify-end mb-4">
                <a href="{{ route('attendees.myEvents') }}" class="px-4 py-2 mb-4 text-white bg-green-600 rounded-md">
                    My Events
                </a>
            </div>

            <!-- Venue Filter -->
            <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
                <div class="flex gap-2">
                    <input type="text" name="location" value="{{ request('location') }}" placeholder="Filter by Location"
                           class="w-64 px-3 py-2 border rounded-md">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Filter</button>
                </div>
            </form>

            <!-- Success and Error Messages -->
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-4 mb-4 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 text-red-800 p-4 mb-4 rounded-md">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Dashboard Stats -->
            <div class="bg-white p-6 shadow rounded-lg grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-blue-100 p-4 rounded-lg shadow">
                    <h4 class="text-lg font-semibold text-blue-800">Total Events</h4>
                    <p class="text-2xl font-bold text-blue-600">{{ $events->count() }}</p>
                </div>
                <div class="bg-green-100 p-4 rounded-lg shadow">
                    <h4 class="text-lg font-semibold text-green-800">Upcoming Events</h4>
                    <p class="text-2xl font-bold text-green-600">{{ $upcomingEventsCount ?? 0 }}</p>
                </div>
                <div class="bg-yellow-100 p-4 rounded-lg shadow">
                    <h4 class="text-lg font-semibold text-yellow-800">Past Events</h4>
                    <p class="text-2xl font-bold text-yellow-600">{{ $pastEventsCount ?? 0 }}</p>
                </div>
            </div>

            <!-- Event Listing Grouped by Venue -->
            @php
                $groupedEvents = $events->groupBy('venue.name');
            @endphp

            @foreach ($groupedEvents as $venueName => $venueEvents)
                <div class="bg-white p-6 shadow rounded-lg mt-6">
                    <h3 class="text-xl font-medium text-gray-900 mb-4">
                        Events at {{ $venueName ?? 'No Venue' }}
                    </h3>

                    <table class="min-w-full table-auto">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 text-left">Title</th>
                                <th class="py-2 px-4 text-left">Start Date</th>
                                <th class="py-2 px-4 text-left">End Date</th>
                                <th class="py-2 px-4 text-left">Venue</th>
                                <th class="py-2 px-4 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($venueEvents as $event)
                                <tr>
                                    <td class="py-2 px-4">{{ $event->title }}</td>
                                    <td class="py-2 px-4">{{ \Carbon\Carbon::parse($event->start_date)->toDateString() }}</td>
                                    <td class="py-2 px-4">{{ \Carbon\Carbon::parse($event->end_date)->toDateString() }}</td>
                                    <td class="py-2 px-4">
                                        @if ($event->venue)
                                            <a href="{{ route('venues.show', $event->venue->id) }}" class="text-blue-500">{{ $event->venue->name }}</a>
                                        @else
                                            <span class="text-gray-500">No Venue</span>
                                        @endif
                                    </td>
                                    <td class="py-2 px-4">
                                        @if (auth()->user()->is_admin)
                                            <a href="{{ route('events.edit', $event->id) }}" class="text-blue-500">Edit</a> |
                                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500">Delete</button>
                                            </form>
                                        @else
                                            <span class="text-gray-500">No Permissions</span>
                                        @endif
                                        <a href="{{ route('events.show', $event->id) }}" class="text-green-500 hover:underline ml-2">View Details</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach

            <!-- Create Event Button -->
            <div class="flex justify-end mt-4">
                <a href="{{ route('events.create') }}" class="px-4 py-2 text-white bg-blue-600 rounded-md">Create Event</a>
            </div>
        </div>
    </div>
</x-app-layout>
