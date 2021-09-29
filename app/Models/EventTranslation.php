<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventTranslation extends Model
{
    protected $table = 'event_translations';

    protected $fillable = ['title', 'description'];

    public $timestamps = false;
}
