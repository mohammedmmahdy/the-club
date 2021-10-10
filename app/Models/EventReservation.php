<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventReservation extends Model
{
    protected $fillable = [
        'event_id',
        'user_id',

        'first_name',
        'last_name',
        'phone',
        'number_of_tickets',
        'status',

    ];

    ################################# Relations #################################

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }


    ################################# Scopes #################################

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }

}