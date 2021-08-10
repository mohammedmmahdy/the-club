<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqCategoryTranslation extends Model
{
    protected $table = 'faq_category_translations';

    protected $primaryKey = 'trans_id';

    protected $fillable = ['name'];

    public $timestamps = false;
}
