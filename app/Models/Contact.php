<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Contact
 * @package App\Models
 * @version June 7, 2020, 7:21 am UTC
 *
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $message
 */
class Contact extends Model
{
    use SoftDeletes;

    public $table = 'contacts';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'message' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|min:3|max:191',
        'email' => 'required|email|min:3|max:191',
        'phone' => 'required',
        'subject' => 'required|string|min:3|max:191',
        'message' => 'required|string|min:3',
    ];
}
