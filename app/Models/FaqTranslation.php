<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqTranslation extends Model
{
    protected $table = 'faq_translations';

    protected $primaryKey = 'trans_id';

    protected $fillable = ['question', 'answer'];

    public $timestamps = false;
}
