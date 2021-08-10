<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class AppFeature
 * @package App\Models
 * @version April 4, 2021, 3:31 pm UTC
 *
 * @property integer $icon
 */
class AppFeature extends Model
{
    use SoftDeletes, Translatable;


    public $table = 'app_features';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'icon'
    ];

    public $translatedAttributes = ['text', 'description'];


    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.text'] = 'required|string|max:191';
            $rules[$language . '.description'] = 'required|string|max:255';
        }

        $rules['icon'] = 'required';

        return $rules;
    }
}
