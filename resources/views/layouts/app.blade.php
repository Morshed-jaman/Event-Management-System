<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

            <!-- Notification Bell -->
            <div class="relative ml-4 px-4">
                <button id="notificationToggle" class="relative focus:outline-none">
                    <svg class="w-6 h-6 text-gray-600 hover:text-gray-800" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    @if(auth()->user()->unreadNotifications->count())
                        <span class="absolute top-0 right-0 inline-flex w-2 h-2 bg-red-600 rounded-full"></span>
                    @endif
                </button>

                <!-- Dropdown -->
                <div id="notificationDropdown"
                    class="hidden absolute right-0 mt-2 w-80 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                    <div class="p-4">
                        <h4 class="text-base font-semibold text-gray-800 mb-2">Notifications</h4>

                        @forelse(auth()->user()->unreadNotifications as $notification)
                            <div class="mb-3 p-2 border rounded bg-gray-50">
                                <p class="text-sm text-gray-700">{{ $notification->data['message'] }}</p>
                                <div class="flex justify-between items-center mt-2">
                                    <a href="{{ $notification->data['url'] }}"
                                        class="text-blue-600 text-xs hover:underline">View</a>
                                    <form method="POST" action="{{ route('notifications.markAsRead', $notification->id) }}">
                                        @csrf
                                        <button type="submit"
                                            class="text-gray-400 hover:text-gray-600 text-xs">Mark as read</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">No new notifications.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Include Navigation -->
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Notification Dropdown Toggle Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const toggle = document.getElementById('notificationToggle');
                const dropdown = document.getElementById('notificationDropdown');

                toggle.addEventListener('click', function (e) {
                    e.stopPropagation();
                    dropdown.classList.toggle('hidden');
                });

                document.addEventListener('click', function () {
                    dropdown.classList.add('hidden');
                });
            });
        </script>
    </body>
</html>
