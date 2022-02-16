<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class EventCategory
 * @package App\Models
 * @version December 5, 2021, 12:11 pm UTC
 *
 * @property string $name
 * @property integer $price
 */
class EventCategory extends Model
{
    use SoftDeletes, Translatable;


    public $table = 'event_categories';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
    ];


    public $translatedAttributes =  ['name'];

    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.name'] = 'required|string|min:3|max:191';
        }

        return $rules;
    }


}
