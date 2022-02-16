<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsTranslation extends Model
{
    protected $table = 'news_translations';

    protected $fillable = ['title', 'body'];

    public $timestamps = false;
}
