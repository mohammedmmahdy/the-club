<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Playground
 * @package App\Models
 * @version October 7, 2021, 10:16 am UTC
 *
 * @property integer $type_id
 * @property string $name
 * @property string $description
 */
class Playground extends Model
{
    use SoftDeletes, Translatable;


    public $table = 'playgrounds';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'playground_type_id',
        'branch_id',
        'price',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'playground_type_id' => 'integer',
        'name' => 'string',
        'description' => 'string'
    ];

    public $translatedAttributes =  ['name', 'description'];

    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.name'] = 'required|string|min:3|max:191';
            $rules[$language . '.description'] = 'required|string|min:3';
        }

        $rules['playground_type_id'] = 'required|integer|exists:playground_types,id';
        $rules['branch_id'] = 'required|integer|exists:branches,id';

        return $rules;
    }

    ###################### Relations ############################

    public function playgroundType()
    {
        return $this->belongsTo(PlaygroundType::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function reservations()
    {
        return $this->hasMany(PlaygroundReservation::class);
    }

}
