<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 drop-shadow">
            Edit Venue
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 to-purple-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if (auth()->user()->is_admin)
                <div class="bg-white/80 backdrop-blur-md p-8 rounded-2xl shadow-2xl animate-fade-in-down">
                    <form method="POST" action="{{ route('venues.update', $venue->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-semibold text-indigo-700">Venue Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $venue->name) }}"
                                   required
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-300" />
                        </div>

                        <!-- Location -->
                        <div class="mb-6">
                            <label for="location" class="block text-sm font-semibold text-indigo-700">Location</label>
                            <input type="text" name="location" id="location" value="{{ old('location', $venue->location) }}"
                                   required
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 transition duration-300" />
                        </div>

                        <!-- Capacity -->
                        <div class="mb-6">
                            <label for="capacity" class="block text-sm font-semibold text-indigo-700">Capacity</label>
                            <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $venue->capacity) }}"
                                   required
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500 transition duration-300" />
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                    class="px-6 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-lg shadow hover:from-indigo-700 hover:to-purple-700 transition duration-300">
                                💾 Update Venue
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div class="bg-red-100 border border-red-200 text-red-800 px-6 py-4 rounded-lg shadow-lg animate-fade-in-up">
                    <h3 class="font-bold text-lg mb-1">🚫 Access Denied</h3>
                    <p>You do not have permission to edit this venue.</p>
                    <a href="{{ route('venues.index') }}" class="mt-4 inline-block text-sm text-indigo-600 hover:underline">← Back to Venue List</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
