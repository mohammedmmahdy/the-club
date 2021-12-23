<?php

namespace App\Models;

use Eloquent as Model;
use App\Helpers\ImageUploaderTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;

class Notification extends Model
{
    use SoftDeletes, Translatable, ImageUploaderTrait;


    public $table = 'notifications';


    protected $dates = ['deleted_at'];

    public $translatedAttributes =  ['title', 'brief', 'description'];

    public $fillable = [
        'user_id',
        'photo',
        'icon',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'brief' => 'string',
        'description' => 'string',
        'photo' => 'string',
    ];

    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.title'] = 'required|string|min:3|max:191';
            $rules[$language . '.brief'] = 'required|string|min:3|max:191';
            $rules[$language . '.description'] = 'required|string';
        }

        $rules['photo'] = 'nullable|image|mimes:jpeg,jpg,png';
        $rules['icon'] = 'nullable|image|mimes:jpeg,jpg,png';

        return $rules;
    }

    /**
     * Prepare Photo to save
     *
     * @param [type] $file
     * @return void
     */
    public function setPhotoAttribute($file)
    {
        if ($file) {
            try {
                $fileName = $this->createFileName($file);

                $this->originalImage($file, $fileName);

                $this->thumbImage($file, $fileName, 300, 200);

                $this->attributes['photo'] = $fileName;
            } catch (\Throwable $th) {
                $this->attributes['photo'] = $file;
            }
        }
    }

    /**
     * Prepare icon to save
     *
     * @param [type] $file
     * @return void
     */
    public function setIconAttribute($file)
    {
        if ($file) {
            try {
                $fileName = $this->createFileName($file);

                $this->originalImage($file, $fileName);

                $this->thumbImage($file, $fileName, 150, 150);

                $this->attributes['icon'] = $fileName;
            } catch (\Throwable $th) {
                $this->attributes['icon'] = $file;
            }
        }
    }

    ################################### Appends #####################################

    protected $appends = [
        'photo_original_path',
        'photo_thumbnail_path',
        'icon_original_path',
        'icon_thumbnail_path',
    ];

    // Photo
    public function getPhotoOriginalPathAttribute()
    {
        return $this->photo ? asset('uploads/images/original/' . $this->photo) : null;
    }

    public function getPhotoThumbnailPathAttribute()
    {
        return $this->photo ? asset('uploads/images/thumbnail/' . $this->photo) : null;
    }

    // Icon
    public function getIconOriginalPathAttribute()
    {
        return $this->icon ? asset('uploads/images/original/' . $this->icon) : null;
    }

    public function getIconThumbnailPathAttribute()
    {
        return $this->icon ? asset('uploads/images/thumbnail/' . $this->icon) : null;
    }

}
