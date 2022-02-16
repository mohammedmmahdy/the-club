<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'payment_type',
        'amount',
        'reservable_type',
        'reservable_id',
    ];





    public function reservable()
    {
        return $this->morphTo();
    }
}
