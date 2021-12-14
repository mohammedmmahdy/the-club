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

        'strMemberName',
        'member_mobile',
        'progress',
        'status',

        'age',
        'gender', // 1 => Male, 2 => Female
    ];

    ################################# Relations #################################

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function academy()
    {
        return $this->belongsTo(Academy::class);
    }

    public function appointment()
    {
        return $this->belongsTo(AcademySchedule::class, 'academy_schedule_id', 'id');
    }

    ################################# Scopes #################################

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }

}
