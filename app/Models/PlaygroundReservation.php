<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class PlaygroundReservation
 * @package App\Models
 * @version October 7, 2021, 10:21 am UTC
 *
 * @property integer $playground_id
 * @property string $date
 * @property string $time
 * @property integer $number_of_people
 */
class PlaygroundReservation extends Model
{
    use SoftDeletes;


    public $table = 'playground_reservations';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'playground_id',
        'user_id',
        'date',
        'time',
        'number_of_people'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'playground_id' => 'integer',
        // 'date' => 'datetime',
        // 'time' => 'datetime',
        'number_of_people' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


    ####################### Relations #########################

    public function playground()
    {
        return $this->belongsTo(Playground::class);
    }

}
