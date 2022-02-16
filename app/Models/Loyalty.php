<?php

namespace App\Models;

use App\Helpers\ImageUploaderTrait;
use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Loyalty
 * @package App\Models
 * @version February 16, 2022, 3:16 pm EET
 *
 * @property string $photo
 * @property integer $discount_value
 * @property string $title
 * @property string $brief
 * @property string $description
 */
class Loyalty extends Model
{
    use SoftDeletes, ImageUploaderTrait, Translatable;


    public $table = 'loyalties';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'photo',
        'discount_value',
        'title',
        'brief',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'photo' => 'string',
        'description' => 'string',
        'discount_value' => 'integer',
    ];


    public $translatedAttributes =  ['title', 'brief','description'];

    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.title'] = 'required|string|max:191';
            $rules[$language . '.brief'] = 'required|string|max:191';
            $rules[$language . '.description'] = 'required|string';
        }

        $rules['photo'] = 'required|image|mimes:jpeg,jpg,png';
        $rules['discount_value'] = 'required|integer';

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



    ################################### Appends #####################################

    protected $appends = [
        'photo_original_path',
        'photo_thumbnail_path',
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





}
