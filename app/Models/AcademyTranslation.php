<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademyTranslation extends Model
{

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'academy_translations';

    protected $fillable = ['name', 'about', 'team'];

    public $timestamps = false;
}
