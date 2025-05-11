<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\AttendeeController; // Add AttendeeController
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------|
| Web Routes                                                                |
|--------------------------------------------------------------------------|
| These routes are loaded by the RouteServiceProvider and assigned         |
| to the "web" middleware group.                                            |
|--------------------------------------------------------------------------|
*/

// Public Route (Homepage)
Route::get('/', function () {
    return view('welcome');
});

// Authenticated Routes
Route::middleware(['auth'])->group(function () {

    // Dashboard Route
    Route::get('/dashboard', [EventController::class, 'index'])->name('dashboard');

    // Profile Management Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Event Management Routes
    Route::resource('events', EventController::class);

    // Venue Management Routes ✅ (this fixes route('venues.show') and others)
    Route::resource('venues', VenueController::class);

    // Attendee Management Routes (newly added for attendee registration and management)
    Route::post('/events/{event}/register', [AttendeeController::class, 'register'])->name('events.register'); // Register for event
    Route::get('/my-events', [AttendeeController::class, 'myEvents'])->name('attendees.myEvents'); // View registered events
    Route::post('/events/{event}/unregister', [AttendeeController::class, 'unregister'])->name('events.unregister'); // Unregister from event
    // routes/web.php
    Route::post('/notifications/{id}/mark-as-read', function ($id) {
       $notification = auth()->user()->notifications()->find($id);
       if ($notification) {
           $notification->markAsRead();
       }
       return back();
    })->name('notifications.markAsRead');


    // Logout Route
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Breeze Auth Routes (login, register, etc.)
require __DIR__.'/auth.php';
