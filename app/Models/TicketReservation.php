<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class TicketReservation
 * @package App\Models
 * @version October 14, 2021, 11:30 am UTC
 *
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $date
 * @property integer $number_of_people
 * @property integer $price
 */
class TicketReservation extends Model
{
    use SoftDeletes;


    public $table = 'ticket_reservations';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'strMemberName',
        'member_mobile',
        'date',
        'number_of_people',
        'price'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'first_name' => 'string',
        'last_name' => 'string',
        'phone' => 'string',
        'date' => 'datetime',
        'number_of_people' => 'integer',
        'price' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];





    public function paymentHistory()
    {
        return $this->morphOne(PaymentHistory::class, 'reservable');
    }


}
