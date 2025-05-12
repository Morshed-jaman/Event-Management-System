<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 drop-shadow">
            Manage Venues
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 to-purple-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- ✅ Flash Message for Success -->
            @if (session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-3 rounded-md shadow-md animate-pulse">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white/80 backdrop-blur-md p-6 shadow-xl rounded-2xl">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">🎯 All Venues</h3>
                    <div class="flex gap-3">
                        <!-- Back -->
                        <a href="{{ route('dashboard') }}"
                           class="px-4 py-2 bg-gray-700 text-white rounded-lg shadow hover:bg-gray-800 transition duration-200">
                            ← Back to Dashboard
                        </a>

                        <!-- Add Venue Button -->
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('venues.create') }}"
                               class="px-5 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg font-semibold shadow hover:from-blue-600 hover:to-indigo-700 transition duration-300">
                                ➕ Add Venue
                            </a>
                        @else
                            <button type="button"
                                    onclick="alert('🚫 You do not have permission to add venues.')"
                                    class="px-5 py-2 bg-gradient-to-r from-blue-300 to-indigo-400 text-white rounded-lg opacity-80 cursor-not-allowed">
                                ➕ Add Venue
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto rounded-lg">
                    <table class="min-w-full table-auto text-sm border border-gray-200 shadow-sm">
                        <thead class="bg-indigo-100 text-indigo-700 font-semibold">
                            <tr>
                                <th class="px-5 py-3 text-left">🏷️ Name</th>
                                <th class="px-5 py-3 text-left">📍 Location</th>
                                <th class="px-5 py-3 text-left">👥 Capacity</th>
                                <th class="px-5 py-3 text-left">⚙️ Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800">
                            @foreach ($venues as $venue)
                                <tr class="border-b hover:bg-indigo-50 transition duration-200">
                                    <td class="px-5 py-3 font-medium">{{ $venue->name }}</td>
                                    <td class="px-5 py-3">{{ $venue->location }}</td>
                                    <td class="px-5 py-3">{{ $venue->capacity }}</td>
                                    <td class="px-5 py-3 space-x-2">
                                        <a href="{{ route('venues.show', $venue->id) }}"
                                           class="text-blue-600 font-medium hover:underline">View</a>

                                        @if (auth()->user()->is_admin)
                                            <a href="{{ route('venues.edit', $venue->id) }}"
                                               class="text-green-600 font-medium hover:underline">Edit</a>
                                            <form action="{{ route('venues.destroy', $venue->id) }}" method="POST"
                                                  class="inline-block"
                                                  onsubmit="return confirm('❗ Are you sure you want to delete this venue?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-600 font-medium hover:underline">Delete</button>
                                            </form>
                                        @else
                                            <span class="text-gray-400 italic">No Permissions</span>
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
