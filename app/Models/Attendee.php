<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    use HasFactory;

    // We specify that we want to fill in the 'user_id' and 'event_id' for the attendees table
    protected $fillable = [
        'user_id', 
        'event_id'
    ];

    // Relationship with the User model (each attendee is a user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with the Event model (each attendee belongs to an event)
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
