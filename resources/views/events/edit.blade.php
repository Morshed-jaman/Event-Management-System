<x-app-layout>
    <x-slot name="header">
        <h2 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-700 via-purple-600 to-pink-500 drop-shadow-sm">
            Edit Event
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-100 to-indigo-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (auth()->user()->is_admin)

                <div class="bg-white/90 backdrop-blur-lg p-10 rounded-3xl shadow-xl border border-indigo-100">

                    <!-- Back to Dashboard -->
                    <div class="mb-6">
                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium rounded-full shadow transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Back to Dashboard
                        </a>
                    </div>

                    <h3 class="text-2xl font-semibold text-indigo-800 mb-8 border-b pb-2">🛠️ Update Event Information</h3>

                    <form action="{{ route('events.update', $event->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Event Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $event->title) }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition" />
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Event Description</label>
                            <textarea name="description" id="description" rows="4" required
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500 transition">{{ old('description', $event->description) }}</textarea>
                        </div>

                        <!-- Start Date -->
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                            <input type="date" name="start_date" id="start_date"
                                   value="{{ old('start_date', \Carbon\Carbon::parse($event->start_date)->toDateString()) }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 transition" />
                        </div>

                        <!-- End Date -->
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                            <input type="date" name="end_date" id="end_date"
                                   value="{{ old('end_date', \Carbon\Carbon::parse($event->end_date)->toDateString()) }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500 transition" />
                        </div>

                        <!-- Venue Dropdown -->
                        <div>
                            <label for="venue_id" class="block text-sm font-medium text-gray-700 mb-1">Choose Venue</label>
                            <select name="venue_id" id="venue_id" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition">
                                <option value="">-- Select Venue --</option>
                                @foreach ($venues as $venue)
                                    <option value="{{ $venue->id }}" {{ old('venue_id', $event->venue_id) == $venue->id ? 'selected' : '' }}>
                                        {{ $venue->name }} - {{ $venue->location }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                    class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white text-sm font-semibold rounded-full shadow hover:from-indigo-600 hover:to-purple-700 transition duration-300">
                                ✅ Update Event
                            </button>
                        </div>
                    </form>
                </div>

            @else
                <!-- Non-admin user message -->
                <div class="bg-red-100 border border-red-200 text-red-800 px-6 py-4 rounded-xl shadow-lg mt-4 animate-fade-in-up">
                    <h3 class="font-bold text-lg mb-1">🚫 Access Denied</h3>
                    <p>You do not have permission to edit this event.</p>
                    <a href="{{ route('dashboard') }}" class="mt-4 inline-block text-sm text-indigo-600 hover:underline">← Back to Dashboard</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
