<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformationTranslation extends Model
{

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'information_translations';

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
    protected $fillable = ['name', 'value'];

    public $timestamps = false;
}
