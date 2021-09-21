<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademySubscription extends Model
{
    protected $table = 'academy_subscriptions';

    protected $fillable = [
        'academy_id',
        'user_id',
        'academy_schedule_id',
        'name',
        'age',
        'gender', // 1 => Male, 2 => Female
    ];

}
