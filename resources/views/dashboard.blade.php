<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <!-- Icon -->
            <div class="p-2 rounded-full bg-indigo-600 shadow-md animate-bounce-slow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2h6v2m0 0h-6m6 0v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2m6-6V9a3 3 0 00-3-3H9a3 3 0 00-3 3v2m12 0H6" />
                </svg>
            </div>
        
            <!-- Heading and Subtitle -->
            <div>
                <h2 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 drop-shadow-md tracking-wide">
                    Event Management System
                </h2>
                <p class="text-sm text-gray-500 tracking-wide mt-1">
                    Manage your events, venues & attendees with ease.
                </p>
            </div>
        </div>
        
        
    </x-slot>

    <div class="flex min-h-screen bg-gradient-to-r from-blue-50 via-purple-50 to-indigo-50">
        <!-- Sidebar -->
        <div class="w-64 h-full bg-gradient-to-b from-indigo-600 via-purple-600 to-pink-500 text-white shadow-xl">
            <div class="p-6">
                <!-- Logo and Title -->
                <div class="flex items-center gap-3 mb-10">
                    <div class="bg-white bg-opacity-20 backdrop-blur-md p-3 rounded-full shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 7h18M5 7l1.664 11.197A2 2 0 006.648 20h10.704a2 2 0 001.984-1.803L19 7" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-extrabold tracking-wider bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 via-white to-green-400 animate-pulse">
                        Event<span class="font-bold">Board</span>
                    </h1>
                </div>
        
                <!-- Navigation Links -->
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('venues.index') }}" class="group flex items-center gap-3 px-4 py-2 rounded-xl hover:bg-white hover:bg-opacity-20 transition-all duration-300">
                            <div class="p-2 rounded-full bg-gradient-to-br from-blue-400 to-indigo-500 shadow-md group-hover:scale-110 transform transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 7h18M5 7l1.664 11.197A2 2 0 006.648 20h10.704a2 2 0 001.984-1.803L19 7" />
                                </svg>
                            </div>
                            <span class="text-white font-medium group-hover:tracking-wide transition-all duration-300">Manage Venues</span>
                        </a>
                    </li>
        
                    <li>
                        <a href="{{ route('attendees.myEvents') }}" class="group flex items-center gap-3 px-4 py-2 rounded-xl hover:bg-white hover:bg-opacity-20 transition-all duration-300">
                            <div class="p-2 rounded-full bg-gradient-to-br from-pink-400 to-purple-500 shadow-md group-hover:scale-110 transform transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8c-1.657 0-3 .895-3 2v4c0 1.105 1.343 2 3 2s3-.895 3-2v-4c0-1.105-1.343-2-3-2zM17 8h1a1 1 0 011 1v6a1 1 0 01-1 1h-1M6 8H5a1 1 0 00-1 1v6a1 1 0 001 1h1" />
                                </svg>
                            </div>
                            <span class="text-white font-medium group-hover:tracking-wide transition-all duration-300">My Events</span>
                        </a>
                    </li>
        
                    <li>
                        <a href="{{ route('events.create') }}" class="group flex items-center gap-3 px-4 py-2 rounded-xl hover:bg-white hover:bg-opacity-20 transition-all duration-300">
                            <div class="p-2 rounded-full bg-gradient-to-br from-yellow-400 to-red-500 shadow-md group-hover:scale-110 transform transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <span class="text-white font-medium group-hover:tracking-wide transition-all duration-300">Create Event</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Event Banner Image -->
            <div class="mb-6 text-center">
                <img src="{{ asset('image/events/Event.jpeg') }}" alt="Event Management" class="max-w-full h-auto rounded-lg shadow-lg mx-auto">
            </div>

            <!-- Success and Error Messages -->
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-4 mb-4 rounded-lg shadow-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 text-red-800 p-4 mb-4 rounded-lg shadow-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Dashboard Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <!-- Total Events -->
                <div class="flex items-center gap-4 p-6 bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-2xl shadow-xl hover:scale-[1.02] transition-transform duration-300">
                    <div class="bg-white bg-opacity-20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-lg font-semibold">Total Events</p>
                        <p class="text-3xl font-bold">{{ $events->count() }}</p>
                    </div>
                </div>
            
                <!-- Upcoming Events -->
                <div class="flex items-center gap-4 p-6 bg-gradient-to-r from-green-400 to-green-600 text-white rounded-2xl shadow-xl hover:scale-[1.02] transition-transform duration-300">
                    <div class="bg-white bg-opacity-20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 17v-2h6v2m0 0v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2m6 0H9m6-4H9"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-lg font-semibold">Upcoming Events</p>
                        <p class="text-3xl font-bold">{{ $upcomingEventsCount ?? 0 }}</p>
                    </div>
                </div>
            
                <!-- Past Events -->
                <div class="flex items-center gap-4 p-6 bg-gradient-to-r from-yellow-400 to-yellow-600 text-white rounded-2xl shadow-xl hover:scale-[1.02] transition-transform duration-300">
                    <div class="bg-white bg-opacity-20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3m5 0a9 9 0 11-6.219-8.56"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-lg font-semibold">Past Events</p>
                        <p class="text-3xl font-bold">{{ $pastEventsCount ?? 0 }}</p>
                    </div>
                </div>
            </div>
            

            <!-- Event Filter -->
            <form method="GET" action="{{ route('dashboard') }}" class="mb-8">
                <div class="flex flex-wrap gap-3 items-center">
                    <input
                        type="text"
                        name="location"
                        value="{{ request('location') }}"
                        placeholder="Search by location..."
                        class="w-72 px-4 py-2 rounded-lg border border-transparent bg-white shadow focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition duration-300"
                    />
                    <button
                        type="submit"
                        class="px-6 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold rounded-lg shadow hover:from-indigo-600 hover:to-purple-700 transition duration-300"
                    >
                        🔍 Filter
                    </button>
                </div>
            </form>
            

          <!-- Event Listing Grouped by Venue -->
@php
$groupedEvents = $events->groupBy('venue.name');
@endphp

<div class="mt-8 space-y-10">
@foreach ($groupedEvents as $venueName => $venueEvents)
    <div class="rounded-xl shadow-xl bg-white/80 backdrop-blur-md p-6 transition hover:shadow-2xl">
        <h3 class="text-xl font-extrabold text-indigo-800 mb-5 border-b pb-2 border-indigo-100">
            Events at {{ $venueName ?? 'No Venue' }}
        </h3>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border-collapse">
                <thead class="bg-gradient-to-r from-indigo-100 via-purple-100 to-indigo-100 text-indigo-800 font-semibold">
                    <tr>
                        <th class="px-4 py-3 rounded-tl-xl">Title</th>
                        <th class="px-4 py-3">Start Date</th>
                        <th class="px-4 py-3">End Date</th>
                        <th class="px-4 py-3">Venue</th>
                        <th class="px-4 py-3 rounded-tr-xl">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800">
                    @foreach ($venueEvents as $event)
                        <tr class="hover:bg-indigo-50 transition-all duration-300 border-b border-gray-100">
                            <td class="px-4 py-3 font-medium">{{ $event->title }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($event->start_date)->toDateString() }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($event->end_date)->toDateString() }}</td>
                            <td class="px-4 py-3">
                                @if ($event->venue)
                                    <a href="{{ route('venues.show', $event->venue->id) }}"
                                       class="text-indigo-500 hover:underline">{{ $event->venue->name }}</a>
                                @else
                                    <span class="text-gray-400 italic">No Venue</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 flex flex-wrap gap-2 items-center text-sm">
                                @if (auth()->user()->is_admin)
                                    <a href="{{ route('events.edit', $event->id) }}"
                                       class="text-blue-600 hover:underline font-medium">Edit</a>
                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline font-medium">Delete</button>
                                    </form>
                                @else
                                    <span class="text-gray-500 italic">No Permissions</span>
                                @endif
                                <a href="{{ route('events.show', $event->id) }}"
                                   class="text-green-600 font-semibold hover:underline">View Details</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endforeach
</div>

</div> <!-- End Main Content -->
</div> <!-- End Layout Flex Container -->
</x-app-layout>

