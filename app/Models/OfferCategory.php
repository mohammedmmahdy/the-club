<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class OfferCategory
 * @package App\Models
 * @version December 29, 2021, 11:23 am UTC
 *
 * @property string $name
 */
class OfferCategory extends Model
{
    use SoftDeletes, Translatable;


    public $table = 'offer_categories';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];


    public $translatedAttributes =  ['name'];

    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.name'] = 'required|string';
        }

        return $rules;
    }


}
