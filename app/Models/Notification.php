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
        'btn_to',
        'photo',
        'type'//1 => All, 2 => Driver, 3 => Customer
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
        'btn_to' => 'string',
        'photo' => 'string',
        'type' => 'string'
    ];

    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.title'] = 'required|string|min:3|max:191';
            $rules[$language . '.brief'] = 'required|string|min:3|max:191';
            $rules[$language . '.description'] = 'required|string';
        }

        $rules['btn_to'] = 'nullable';
        $rules['photo'] = 'required|image|mimes:jpeg,jpg,png';
        $rules['type'] = 'required|in:1,2,3';

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

                $this->thumbImage($file, $fileName, 1920, 358);

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

    public function getPhotoOriginalPathAttribute()
    {
        return $this->photo ? asset('uploads/images/original/' . $this->photo) : null;
    }

    public function getPhotoThumbnailPathAttribute()
    {
        return $this->photo ? asset('uploads/images/thumbnail/' . $this->photo) : null;
    }

    ################################### Scopes #####################################

    public function scopeDriver($query)
    {
        return $query->where('type', 1)->orWhere('type', 2);
    }

    public function scopeCustomer($query)
    {
        return $query->where('type', 1)->orWhere('type', 3);
    }
}
