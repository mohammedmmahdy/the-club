<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetaTranslation extends Model
{
    
    /**
     * Table name.
     * 
     * @var string
     */
    protected $table = 'meta_translations';

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
    protected $fillable = ['title', 'description', 'keywords'];

    /**
     * Timestamps.
     * 
     * @var boolean
     */
    public $timestamps = false;
}
