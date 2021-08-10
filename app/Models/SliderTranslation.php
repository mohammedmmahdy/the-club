<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderTranslation extends Model
{

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'slider_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = ['title', 'subtitle', 'content', 'button_text'];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
