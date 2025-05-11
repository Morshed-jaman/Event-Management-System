<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Upcoming Events</h3>
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Event Name</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Date</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Location</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $event->title }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ \Carbon\Carbon::parse($event->start_date)->toDateString() }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $event->location }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-right">
                                        <!-- View Event Details Button -->
                                        <a href="{{ route('events.show', $event->id) }}" class="text-blue-500 hover:text-blue-900">View Details</a> |

                                        <!-- Register/Unregister for the event (if not already registered) -->
                                        @if (auth()->check() && auth()->user()->events->contains($event))
                                            <span class="text-green-600">You are registered</span>
                                        @else
                                            <form action="{{ route('events.register', $event->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="text-indigo-600 hover:text-indigo-900">Register</button>
                                            </form>
                                        @endif

                                        <!-- Edit and Delete Buttons (for Admin only) -->
                                        @if (auth()->check() && auth()->user()->is_admin)
                                            | <a href="{{ route('events.edit', $event->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a> |
                                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
