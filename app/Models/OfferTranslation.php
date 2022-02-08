<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferTranslation extends Model
{

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'offer_translations';

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
