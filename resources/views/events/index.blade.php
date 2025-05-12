<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-700 via-purple-600 to-pink-500 drop-shadow-sm">
            Events
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-100 to-indigo-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-md shadow-2xl rounded-2xl overflow-hidden p-8 border border-indigo-100">
                <h3 class="text-2xl font-semibold text-indigo-800 mb-6">📅 Upcoming Events</h3>

                <div class="overflow-x-auto rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-indigo-100 text-indigo-700 font-semibold">
                            <tr>
                                <th class="px-6 py-3 text-left">Event Name</th>
                                <th class="px-6 py-3 text-left">Date</th>
                                <th class="px-6 py-3 text-left">Location</th>
                                <th class="px-6 py-3 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100 text-gray-800">
                            @foreach ($events as $event)
                                <tr class="hover:bg-indigo-50 transition-all duration-300">
                                    <td class="px-6 py-4 font-medium">{{ $event->title }}</td>
                                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($event->start_date)->toFormattedDateString() }}</td>
                                    <td class="px-6 py-4">{{ $event->location }}</td>
                                    <td class="px-6 py-4 space-x-2">
                                        <!-- View -->
                                        <a href="{{ route('events.show', $event->id) }}"
                                           class="inline-block text-blue-600 hover:underline">🔍 View</a>

                                        <!-- Registration Check -->
                                        @if (auth()->check() && auth()->user()->events->contains($event))
                                            <span class="text-green-600 font-medium">✔ Registered</span>
                                        @else
                                            <form action="{{ route('events.register', $event->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="text-indigo-600 hover:underline">➕ Register</button>
                                            </form>
                                        @endif

                                        <!-- Admin Actions -->
                                        @if (auth()->check() && auth()->user()->is_admin)
                                            <a href="{{ route('events.edit', $event->id) }}"
                                               class="inline-block text-yellow-600 hover:underline">✏ Edit</a>

                                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline-block"
                                                  onsubmit="return confirm('Are you sure you want to delete this event?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">🗑 Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($events->isEmpty())
                    <p class="text-gray-500 mt-6 text-center">No upcoming events available.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
