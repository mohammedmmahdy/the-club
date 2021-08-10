<?php

namespace App\Models;

use App\Helpers\ImageUploaderTrait;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Option
 * @package App\Models
 * @version April 20, 2021, 9:38 am UTC
 *
 * @property integer $min_model_year
 */
class Option extends Model
{
    use SoftDeletes, ImageUploaderTrait;


    public $table = 'options';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'logo',
        'fav_icon',
        'welcome_message',
        'welcome_photo',
    ];

    public static $rules = [
        'logo'              => 'required',
        'fav_icon'          => 'required',
        'welcome_message'   => 'required',
        'welcome_photo'     => 'required',
    ];


    ################################### Appends #####################################

    protected $appends = [
        'logo_original_path',
        'logo_thumbnail_path',
        'fav_icon_original_path',
        'fav_icon_thumbnail_path',
        'welcome_photo_original_path',
        'welcome_photo_thumbnail_path',
    ];

    // fav_icon
    public function setFavIconAttribute($file)
    {
        try {
            if ($file) {

                $fileName = $this->createFileName($file);

                $this->originalImage($file, $fileName);

                $this->thumbImage($file, $fileName, 100, 100);

                $this->attributes['fav_icon'] = $fileName;
            }
        } catch (\Throwable $th) {
            $this->attributes['fav_icon'] = $file;
        }
    }

    public function getFavIconOriginalPathAttribute()
    {
        return $this->fav_icon ? asset('uploads/images/original/' . $this->fav_icon) : null;
    }

    public function getFavIconThumbnailPathAttribute()
    {
        return $this->fav_icon ? asset('uploads/images/thumbnail/' . $this->fav_icon) : null;
    }
    // fav_icon

    // logo
    public function setLogoAttribute($file)
    {
        try {
            if ($file) {

                $fileName = $this->createFileName($file);

                $this->originalImage($file, $fileName);

                $this->thumbImage($file, $fileName, 200, 200);

                $this->attributes['logo'] = $fileName;
            }
        } catch (\Throwable $th) {
            $this->attributes['logo'] = $file;
        }
    }

    public function getLogoOriginalPathAttribute()
    {
        return $this->logo ? asset('uploads/images/original/' . $this->logo) : null;
    }

    public function getLogoThumbnailPathAttribute()
    {
        return $this->logo ? asset('uploads/images/thumbnail/' . $this->logo) : null;
    }
    // logo

    // Welcome Photo
    public function setWelcomePhotoAttribute($file)
    {
        try {
            if ($file) {

                $fileName = $this->createFileName($file);

                $this->originalImage($file, $fileName);

                $this->thumbImage($file, $fileName, 190, 275);

                $this->attributes['welcome_photo'] = $fileName;
            }
        } catch (\Throwable $th) {
            $this->attributes['welcome_photo'] = $file;
        }
    }

    public function getWelcomePhotoOriginalPathAttribute()
    {
        return $this->welcome_photo ? asset('uploads/images/original/' . $this->welcome_photo) : null;
    }

    public function getWelcomePhotoThumbnailPathAttribute()
    {
        return $this->welcome_photo ? asset('uploads/images/thumbnail/' . $this->welcome_photo) : null;
    }
    // Welcome Photo
}
