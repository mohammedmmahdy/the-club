<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChampTranslation extends Model
{
    protected $table = 'champ_translations';

    protected $fillable = ['title', 'body'];

    public $timestamps = false;
}
