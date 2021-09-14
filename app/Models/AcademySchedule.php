<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademySchedule extends Model
{
    protected $table = 'academy_schedules';

    protected $fillable = ['academy_id', 'day', 'from', 'to'];

}
