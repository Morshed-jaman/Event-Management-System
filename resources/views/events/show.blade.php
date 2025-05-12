<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-700 via-purple-600 to-pink-500 drop-shadow-sm">
            Event Details
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-100 to-indigo-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-lg p-8 rounded-2xl shadow-2xl border border-indigo-100">

                <!-- Event Title -->
                <h3 class="text-2xl font-bold text-indigo-800 mb-6">{{ $event->title }}</h3>

                <!-- Description -->
                <div class="mb-4">
                    <span class="font-medium text-gray-700">📄 Description:</span>
                    <p class="text-gray-800 mt-1">{{ $event->description }}</p>
                </div>

                <!-- Start Date -->
                <div class="mb-4">
                    <span class="font-medium text-gray-700">📅 Start Date:</span>
                    <p class="text-gray-800 mt-1">{{ \Carbon\Carbon::parse($event->start_date)->toFormattedDateString() }}</p>
                </div>

                <!-- End Date -->
                <div class="mb-6">
                    <span class="font-medium text-gray-700">⏰ End Date:</span>
                    <p class="text-gray-800 mt-1">{{ \Carbon\Carbon::parse($event->end_date)->toFormattedDateString() }}</p>
                </div>

                <!-- Admin Edit Button -->
                @if (auth()->user()->is_admin)
                    <div class="mb-6">
                        <a href="{{ route('events.edit', $event->id) }}"
                           class="inline-block px-4 py-2 bg-gradient-to-r from-yellow-400 to-yellow-600 text-white rounded-full text-sm font-semibold shadow hover:from-yellow-500 hover:to-yellow-700 transition">
                            ✏️ Update Event (Admin)
                        </a>
                    </div>
                @endif

                <!-- Register/Unregister Button -->
                <div class="mb-6">
                    @if (auth()->check() && auth()->user()->events && auth()->user()->events->contains($event))
                        <form action="{{ route('events.unregister', $event->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white rounded-full text-sm font-semibold shadow transition">
                                🚫 Unregister from Event
                            </button>
                        </form>
                    @else
                        <form action="{{ route('events.register', $event->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full text-sm font-semibold shadow transition">
                                ✅ Register for Event
                            </button>
                        </form>
                    @endif
                </div>

                <!-- Back Button -->
                <div class="mt-6">
                    <a href="{{ route('events.index') }}"
                       class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:underline transition">
                        ← Back to Events
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
