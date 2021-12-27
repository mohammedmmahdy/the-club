<?php

namespace App\Models;

use App\Helpers\ImageUploaderTrait;
use Astrotomic\Translatable\Translatable;
use Eloquent as Model;



/**
 * Class Onboarding
 * @package App\Models
 * @version December 27, 2021, 9:02 am UTC
 *
 * @property string $text
 * @property string $photo
 */
class Onboarding extends Model
{

    use Translatable, ImageUploaderTrait;

    public $table = 'onboardings';

    public $fillable = ['photo'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'text' => 'string',
        'photo' => 'string'
    ];


    public $translatedAttributes =  ['text'];

    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.text'] = 'nullable|string|min:3|max:191';
        }

        $rules['photo'] = 'required|image|mimes:jpg,jpeg,png';

        return $rules;
    }

    protected $appends = [
        'photo_original_path',
        'photo_thumbnail_path',
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


}
