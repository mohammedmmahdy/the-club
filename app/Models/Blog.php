<?php

namespace App\Models;

use App\Helpers\ImageUploaderTrait;
use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Blog
 * @package App\Models
 * @version February 25, 2021, 12:16 pm EET
 *
 * @property string $photo
 */
class Blog extends Model
{
    use SoftDeletes, Translatable, ImageUploaderTrait;

    public $table = 'blogs';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'photo'
    ];


    public $translatedAttributes =  ['title', 'description', 'brief'];

    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.title'] = 'required|string|max:191';
            $rules[$language . '.description'] = 'required|string';
            $rules[$language . '.brief'] = 'required|string';
        }

        $rules['photo'] = 'required';

        return $rules;
    }


    #################################################################################
    ################################### Appends #####################################
    #################################################################################


    protected $appends = ['photo_original_path', 'photo_thumbnail_path'];

    public function getPhotoOriginalPathAttribute()
    {
        return $this->photo ? asset('uploads/images/original/' . $this->photo) : null;
    }

    public function getPhotoThumbnailPathAttribute()
    {
        return $this->photo ? asset('uploads/images/thumbnail/' . $this->photo) : null;
    }


    #################################################################################
    ################################# Functions #####################################
    #################################################################################

    public function setPhotoAttribute($file)
    {
        try {
            if ($file) {

                if ($file) {

                    $fileName = $this->createFileName($file);

                    $this->originalImage($file, $fileName);

                    $this->thumbImage($file, $fileName, 650, 365);

                    $this->attributes['photo'] = $fileName;
                }
            }
        } catch (\Throwable $th) {
            $this->attributes['photo'] = $file;
        }
    }
}
