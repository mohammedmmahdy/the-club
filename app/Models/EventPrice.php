<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPrice extends Model
{
    use HasFactory;

    public $fillable = ['event_id', 'event_category_id', 'price'];

    public $timestamps = false;







    ################################# Relations #################################

    public function eventCategory()
    {
        return $this->belongsTo(EventCategory::class);
    }
}
