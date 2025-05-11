<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'venue_id',  // Assuming you already have a venue_id column for the venue relation
    ];

    /**
     * Define the many-to-many relationship with users (attendees).
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'attendees');  // 'attendees' is the pivot table
    }

    /**
     * Define the relationship with the Venue.
     */
    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
}
