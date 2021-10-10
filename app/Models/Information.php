<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;

/**
 * Class Information
 * @package App\Models
 * @version June 4, 2020, 11:51 am UTC
 *
 * @property string $name
 * @property string $value
 * @property integer $status
 */
class Information extends Model
{
    use SoftDeletes, Translatable;

    public $table = 'informations';


    protected $dates = ['deleted_at'];

    public $translatedAttributes =  ['name', 'value'];


    public $fillable = [
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'value' => 'string',
        'status' => 'integer'
    ];

    public $timestamps = false;


    /**
     * Validation rules
     *
     * @var array
     */
    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.name'] = 'required|string|min:3|max:191';
            $rules[$language . '.value'] = 'required|string';
        }

        $rules['status'] = 'required|in:0,1';

        return $rules;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
