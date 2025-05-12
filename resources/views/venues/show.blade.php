<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-700 via-purple-600 to-pink-500 drop-shadow-sm">
            Venue Details
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-100 to-indigo-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-lg p-8 rounded-2xl shadow-2xl border border-indigo-100">

                <!-- Venue Title -->
                <h3 class="text-2xl font-semibold text-indigo-800 mb-6">{{ $venue->name }}</h3>

                <!-- Venue Info -->
                <div class="mb-4">
                    <span class="font-medium text-gray-700">📍 Location:</span>
                    <p class="text-gray-800 mt-1">{{ $venue->location }}</p>
                </div>

                <div class="mb-6">
                    <span class="font-medium text-gray-700">🏛️ Capacity:</span>
                    <p class="text-gray-800 mt-1">{{ $venue->capacity }}</p>
                </div>

                <!-- Admin Controls -->
                @if (auth()->user()->is_admin)
                    <div class="flex flex-wrap gap-4 mt-6">
                        <a href="{{ route('venues.edit', $venue->id) }}"
                           class="px-5 py-2 bg-gradient-to-r from-yellow-400 to-yellow-600 text-white text-sm font-semibold rounded-full shadow hover:from-yellow-500 hover:to-yellow-700 transition">
                            ✏ Edit Venue
                        </a>

                        <form action="{{ route('venues.destroy', $venue->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this venue?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-5 py-2 bg-gradient-to-r from-red-500 to-red-700 text-white text-sm font-semibold rounded-full shadow hover:from-red-600 hover:to-red-800 transition">
                                🗑 Delete Venue
                            </button>
                        </form>
                    </div>
                @else
                    <div class="mt-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl shadow">
                        🚫 You do not have permission to edit or delete this venue.
                    </div>
                @endif

                <!-- Back Link -->
                <div class="mt-8">
                    <a href="{{ route('venues.index') }}"
                       class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:underline transition">
                        ← Back to Venues
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
