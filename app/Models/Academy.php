<?php

namespace App\Models;

use App\Helpers\ImageUploaderTrait;
use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Academy
 * @package App\Models
 * @version September 13, 2021, 1:22 pm UTC
 *
 * @property integer $branch_id
 * @property string $name
 * @property string $about
 * @property string $team
 * @property string $icon
 */
class Academy extends Model
{
    use SoftDeletes,Translatable,ImageUploaderTrait, HasFactory;


    const WEEK_DAYS =  ['SAT','SUN','MON','TUE','WED','THU','FRI'];

    public $table = 'academies';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'branch_id',
        'name',
        'about',
        'team',
        'icon'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'branch_id' => 'integer',
        'name' => 'string',
        'about' => 'string',
        'team' => 'string',
        'icon' => 'string'
    ];


    public $translatedAttributes =  ['name', 'about', 'team'];

    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.name'] = 'required|string|min:3|max:191';
            $rules[$language . '.about'] = 'required|string|min:3';
            $rules[$language . '.team'] = 'required|string|min:3';
        }
        $rules['branch_id'] = 'required|exists:branches,id';
        $rules['icon']      = 'required|image|mimes:jpg,jpeg,png';

        $rules['photos']    = 'required|array';
        $rules['photos.*']  = 'required|image|mimes:jpg,jpeg,png';

        $rules['time']                 = 'required|array';
        $rules['time.*.day']           = 'required|string|max:191';
        $rules['time.*.from']          = 'required|string';
        $rules['time.*.to']            = 'required|string';

        return $rules;
    }


    ################################### Appends #####################################

    protected $appends = [
        'icon_original_path',
        'icon_thumbnail_path',
    ];
    // icon
    public function setIconAttribute($file)
    {
        try {
            if ($file) {

                $fileName = $this->createFileName($file);

                $this->originalImage($file, $fileName);

                $this->thumbImage($file, $fileName, 200, 200);

                $this->attributes['icon'] = $fileName;
            }
        } catch (\Throwable $th) {
            $this->attributes['icon'] = $file;
        }
    }

    public function getIconOriginalPathAttribute()
    {
        return $this->icon ? asset('uploads/images/original/' . $this->icon) : null;
    }

    public function getIconThumbnailPathAttribute()
    {
        return $this->icon ? asset('uploads/images/thumbnail/' . $this->icon) : null;
    }
    // icon



    ################################### Relations #################################

    public function photos()
    {
        return $this->hasMany(AcademyPhoto::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function schedules()
    {
        return $this->hasMany(AcademySchedule::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(AcademySubscription::class);
    }

}
