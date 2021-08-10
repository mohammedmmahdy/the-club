<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Service
 * @package App\Models
 * @version March 29, 2021, 12:43 pm UTC
 *
 * @property integer $parent_id
 * @property integer $has_children
 * @property integer $status
 */
class AppFeatureTranslation extends Model
{
    protected $table = 'app_feature_translations';

    protected $fillable = ['text', 'description'];

    public $timestamps = false;
}
