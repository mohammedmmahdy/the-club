<?php

namespace App\Models;

use App\Helpers\ImageUploaderTrait;
use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Champ
 * @package App\Models
 * @version February 20, 2022, 11:55 am EET
 *
 * @property string $photo
 * @property string $title
 * @property string $body
 */
class Champ extends Model
{
    use SoftDeletes, ImageUploaderTrait, Translatable;


    public $table = 'champs';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'photo',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'photo' => 'string',
        'title' => 'string',
        'body' => 'string'
    ];


    public $translatedAttributes =  ['title', 'body'];

    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.title'] = 'required|string|min:3|max:191';
            $rules[$language . '.body'] = 'required|string|min:3';
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
