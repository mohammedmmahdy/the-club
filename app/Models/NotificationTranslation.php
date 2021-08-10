<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationTranslation extends Model
{

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'notification_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'trans_id';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = ['title', 'brief', 'description'];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
