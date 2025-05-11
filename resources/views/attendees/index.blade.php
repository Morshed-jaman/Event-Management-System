<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Registered Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Back to Dashboard Button with Color -->
            <a href="{{ route('dashboard') }}"
               class="inline-block mb-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                ← Back to Dashboard
            </a>

            <h3 class="text-xl font-semibold mb-4">My Registered Events</h3>
            
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

            <table class="min-w-full table-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left">Event Name</th>
                        <th class="px-4 py-2 text-left">Date</th>
                        <th class="px-4 py-2 text-left">Location</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td class="px-4 py-2">{{ $event->title }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($event->start_date)->toDateString() }}</td>
                            <td class="px-4 py-2">{{ $event->venue->name ?? 'No Venue' }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('events.show', $event->id) }}" class="text-blue-500">View Details</a> |
                                <form action="{{ route('events.unregister', $event->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="text-red-500">Unregister</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
