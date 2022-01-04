<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademyReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'academy_id',
        'user_id',
        'rate',
        'comment',
    ];
}
