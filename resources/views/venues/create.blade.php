<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 17v-2h6v2m0 0v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2m6-6V9a3 3 0 00-3-3H9a3 3 0 00-3 3v2m12 0H6"/>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500">
                Create New Venue
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 to-purple-100 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-indigo-100">
                
                <!-- Back Button -->
                <div class="mb-6">
                    <a href="{{ route('venues.index') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg shadow-sm transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Back to Manage Venues
                    </a>
                </div>

                <!-- Venue Form -->
                <form method="POST" action="{{ route('venues.store') }}" class="space-y-6">
                    @csrf

                    <!-- Venue Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Venue Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none" />
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-purple-400 focus:outline-none" />
                    </div>

                    <!-- Capacity -->
                    <div>
                        <label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">Capacity</label>
                        <input type="number" name="capacity" id="capacity" value="{{ old('capacity') }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-pink-400 focus:outline-none" />
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                                class="px-6 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold rounded-lg shadow hover:from-indigo-600 hover:to-purple-700 transition duration-300">
                            ➕ Create Venue
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
