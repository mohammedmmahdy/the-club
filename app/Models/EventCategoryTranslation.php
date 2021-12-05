<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventCategoryTranslation extends Model
{
    protected $table = 'event_category_translations';

    protected $fillable = ['name'];

    public $timestamps = false;
}
