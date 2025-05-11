<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Venue') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if (auth()->user()->is_admin)
                <div class="bg-white p-6 shadow rounded-lg">
                    <form method="POST" action="{{ route('venues.update', $venue->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Venue Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $venue->name) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        </div>

                        <!-- Location -->
                        <div class="mb-4">
                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text" name="location" id="location" value="{{ old('location', $venue->location) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        </div>

                        <!-- Capacity -->
                        <div class="mb-4">
                            <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity</label>
                            <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $venue->capacity) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Update Venue</button>
                        </div>
                    </form>
                </div>
            @else
                <!-- If user is not an admin, display a message -->
                <div class="bg-red-100 text-red-700 p-4 mb-4 rounded-md">
                    <p>You do not have permission to edit this venue.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
