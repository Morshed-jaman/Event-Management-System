<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'name',
        'location',
        'capacity',
    ];

    // Define the relationship with events (if an event belongs to a venue)
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
