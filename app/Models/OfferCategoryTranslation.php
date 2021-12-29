<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferCategoryTranslation extends Model
{

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'offer_category_translations';

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
    protected $fillable = ['name'];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
