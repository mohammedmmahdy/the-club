<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademySchedule extends Model
{
    protected $table = 'academy_schedules';

    protected $fillable = ['academy_id', 'day', 'from', 'to'];

    // ['SAT','SUN','MON','TUE','WED','THU','FRI']
    public function getDayAttribute()
    {
        if (\App::getLocale() == 'en') {
            switch ($this->attributes['day']) {
                case 'SAT': $day = 'SAT'; break;
                case 'SUN': $day = 'SUN'; break;
                case 'MON': $day = 'MON'; break;
                case 'TUE': $day = 'TUE'; break;
                case 'WED': $day = 'WED'; break;
                case 'THU': $day = 'THU'; break;
                case 'FRI': $day = 'FRI'; break;

                default:
                    break;
            }
        }else {
            switch ($this->attributes['day']) {
                case 'SAT': $day = 'السبت'; break;
                case 'SUN': $day = 'الاحد'; break;
                case 'MON': $day = 'الاثنين'; break;
                case 'TUE': $day = 'الثلاثاء'; break;
                case 'WED': $day = 'الاربعاء'; break;
                case 'THU': $day = 'الخميس'; break;
                case 'FRI': $day = 'الجمعة'; break;

                default:
                    break;
            }
        }

        return $day;
    }

}
