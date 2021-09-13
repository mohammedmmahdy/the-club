<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchTranslation extends Model
{

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'branch_translations';

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
    protected $fillable = ['name', 'address'];

    public $timestamps = false;
}
