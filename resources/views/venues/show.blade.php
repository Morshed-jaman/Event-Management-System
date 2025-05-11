<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Venue Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white p-6 shadow rounded-lg">
                <h3 class="text-xl font-medium text-gray-900 mb-4">{{ $venue->name }}</h3>
                
                <p><strong>Location:</strong> {{ $venue->location }}</p>
                <p><strong>Capacity:</strong> {{ $venue->capacity }}</p>

                @if (auth()->user()->is_admin)
                    <!-- Only show the Edit and Delete buttons if the user is an admin -->
                    <div class="mt-4">
                        <a href="{{ route('venues.edit', $venue->id) }}" class="text-blue-500 hover:underline">Edit Venue</a>
                    </div>

                    <div class="mt-2">
                        <form action="{{ route('venues.destroy', $venue->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Delete Venue</button>
                        </form>
                    </div>
                @else
                    <!-- If not admin, display a no permission message -->
                    <div class="mt-4">
                        <span class="text-gray-500">You do not have permission to edit or delete this venue.</span>
                    </div>
                @endif

                <div class="mt-6">
                    <a href="{{ route('venues.index') }}" class="text-gray-700 underline">← Back to Venues</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
