<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SocialLink
 * @package App\Models
 * @version October 1, 2020, 8:00 am UTC
 *
 * @property string $name
 * @property string $link
 * @property integer $status
 */
class SocialLink extends Model
{
    use SoftDeletes;

    public $table = 'social_links';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'link',
        'status',
        'icon'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'link' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    /**
     * Timestamps.
     * 
     * @var boolean
     */
    public $timestamps = false;

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
