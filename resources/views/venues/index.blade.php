<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Venues') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- ✅ Flash Message for Success -->
            @if (session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-3 rounded-md shadow-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6 shadow rounded-lg">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">All Venues</h3>
                    <div class="flex gap-2">
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">← Back to Dashboard</a>
                        <a href="{{ route('venues.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Add Venue</a>
                    </div>
                </div>

                <table class="min-w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-left">Location</th>
                            <th class="px-4 py-2 text-left">Capacity</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($venues as $venue)
                            <tr>
                                <td class="px-4 py-2">{{ $venue->name }}</td>
                                <td class="px-4 py-2">{{ $venue->location }}</td>
                                <td class="px-4 py-2">{{ $venue->capacity }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('venues.show', $venue->id) }}" class="text-blue-500">View</a> |
                                    
                                    <!-- Check if the user is an admin before showing the Edit and Delete options -->
                                    @if (auth()->user()->is_admin)
                                        <a href="{{ route('venues.edit', $venue->id) }}" class="text-green-500">Edit</a> |
                                        <form action="{{ route('venues.destroy', $venue->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this venue?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">Delete</button>
                                        </form>
                                    @else
                                        <span class="text-gray-500">No Permissions</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
