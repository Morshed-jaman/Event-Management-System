<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-700 via-purple-600 to-pink-500 drop-shadow-sm">
            Create New Event
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-100 to-indigo-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-xl p-10 border border-indigo-100">

                <!-- Back Button -->
                <div class="mb-6">
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center gap-2 text-sm font-medium px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-full shadow transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Back to Dashboard
                    </a>
                </div>

                <h3 class="text-2xl font-semibold text-indigo-800 mb-8 tracking-wide">
                    📝 Fill in the event details below
                </h3>

                <!-- Event Creation Form -->
                <form method="POST" action="{{ route('events.store') }}" class="space-y-6">
                    @csrf

                    <!-- Event Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Event Title</label>
                        <input type="text" name="title" id="title" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition" />
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Event Description</label>
                        <textarea name="description" id="description" rows="4" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500 transition"></textarea>
                    </div>

                    <!-- Start Date -->
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                        <input type="date" name="start_date" id="start_date" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 transition" />
                    </div>

                    <!-- End Date -->
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                        <input type="date" name="end_date" id="end_date" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500 transition" />
                    </div>

                    <!-- Venue Dropdown -->
                    <div>
                        <label for="venue_id" class="block text-sm font-medium text-gray-700 mb-1">Select Venue</label>
                        <select name="venue_id" id="venue_id" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition">
                            <option value="">-- Choose a Venue --</option>
                            @foreach ($venues as $venue)
                                <option value="{{ $venue->id }}">{{ $venue->name }} ({{ $venue->location }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white text-sm font-semibold rounded-full shadow-lg hover:from-indigo-600 hover:to-purple-700 transition duration-300">
                            ✅ Create Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
