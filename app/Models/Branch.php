<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Branch
 * @package App\Models
 * @version September 13, 2021, 10:49 am UTC
 *
 * @property string $name
 * @property string $address
 */
class Branch extends Model
{
    use SoftDeletes, Translatable;


    public $table = 'branches';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'address'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'address' => 'string'
    ];

    public $translatedAttributes =  ['name', 'address'];

    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.name'] = 'required|string|min:3|max:191';
            $rules[$language . '.address'] = 'required|string|min:3';
        }

        return $rules;
    }
}
