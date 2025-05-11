<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Event Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white p-6 shadow rounded-lg">
                <!-- Event Title -->
                <h3 class="text-xl font-medium text-gray-900 mb-4">{{ $event->title }}</h3>
                
                <div class="mb-4">
                    <strong>Description:</strong> {{ $event->description }}
                </div>
                <div class="mb-4">
                    <strong>Start Date:</strong> {{ \Carbon\Carbon::parse($event->start_date)->toDateString() }}
                </div>
                <div class="mb-4">
                    <strong>End Date:</strong> {{ \Carbon\Carbon::parse($event->end_date)->toDateString() }}
                </div>

                <!-- Admin Update Link -->
                @if (auth()->user()->is_admin)
                    <div class="mt-4">
                        <a href="{{ route('events.edit', $event->id) }}" class="text-blue-600 hover:underline">
                            Update Event (Admin)
                        </a>
                    </div>
                @endif

                <!-- Register/Unregister button for attendees -->
                <div class="mt-4">
                    @if (auth()->check() && auth()->user()->events && auth()->user()->events->contains($event))
                        <form action="{{ route('events.unregister', $event->id) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-900">
                                Unregister from Event
                            </button>
                        </form>
                    @else
                        <form action="{{ route('events.register', $event->id) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="text-blue-600 hover:text-blue-900">
                                Register for Event
                            </button>
                        </form>
                    @endif
                </div>

                <!-- Back to Events Button -->
                <div class="mt-6">
                    <a href="{{ route('events.index') }}" class="text-gray-700 underline">← Back to Events</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
