<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnboardingTranslation extends Model
{
    protected $table = 'onboarding_translations';

    protected $fillable = ['text'];

    public $timestamps = false;
}
