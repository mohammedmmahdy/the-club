<?php

namespace App\Models;

use App\Helpers\ImageUploaderTrait;
use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Event
 * @package App\Models
 * @version September 29, 2021, 12:40 pm UTC
 *
 * @property string $title
 * @property string $description
 * @property string $date
 * @property string $photo
 */
class Event extends Model
{
    use SoftDeletes, Translatable, ImageUploaderTrait;


    public $table = 'events';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'branch_id',
        'title',
        'description',
        'date',
        'icon',
        'photo',
        'members_only',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'description' => 'string',
        'date' => 'datetime',
        'photo' => 'string'
    ];


    public $translatedAttributes =  ['title', 'description'];

    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.title'] = 'required|string|min:3|max:191';
            $rules[$language . '.description'] = 'required|string|min:3';
        }

        $rules['date'] = 'required|date';
        $rules['icon'] = 'required|image|mimes:jpg,jpeg,png';
        $rules['photo'] = 'required|image|mimes:jpg,jpeg,png';

        return $rules;
    }

    protected $appends = [
        'photo_original_path',
        'photo_thumbnail_path',
        'icon_original_path',
        'icon_thumbnail_path',
    ];

    ################### Photo Handling ######################

    // Photo
    public function setPhotoAttribute($file)
    {
        if ($file) {
            try {
                $fileName = $this->createFileName($file);

                $this->originalImage($file, $fileName);

                $this->thumbImage($file, $fileName, 200, 200);

                $this->attributes['photo'] = $fileName;
            } catch (\Throwable $th) {
                $this->attributes['photo'] = $file;
            }
        }
    }

    public function getPhotoOriginalPathAttribute()
    {
        return asset('uploads/images/original/' . $this->photo);
    }
    public function getPhotoThumbnailPathAttribute()
    {
        return asset('uploads/images/thumbnail/' . $this->photo);
    }
    // End Photo

    // Icon
    public function setIconAttribute($file)
    {
        if ($file) {
            try {
                $fileName = $this->createFileName($file);

                $this->originalImage($file, $fileName);

                $this->thumbImage($file, $fileName, 200, 200);

                $this->attributes['icon'] = $fileName;
            } catch (\Throwable $th) {
                $this->attributes['icon'] = $file;
            }
        }
    }

    public function getIconOriginalPathAttribute()
    {
        return asset('uploads/images/original/' . $this->icon);
    }
    public function getIconThumbnailPathAttribute()
    {
        return asset('uploads/images/thumbnail/' . $this->icon);
    }
    // End Icon


    ####################################### Relations #######################################

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function prices()
    {
        return $this->hasMany(EventPrice::class);
    }

}
