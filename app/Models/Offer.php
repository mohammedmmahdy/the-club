<?php

namespace App\Models;

use App\Helpers\ImageUploaderTrait;
use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Offer
 * @package App\Models
 * @version December 29, 2021, 11:26 am UTC
 *
 * @property string $photo
 * @property string $description
 * @property integer $discount_value
 * @property integer $offer_category_id
 */
class Offer extends Model
{
    use SoftDeletes, Translatable, ImageUploaderTrait;


    public $table = 'offers';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'photo',
        'description',
        'discount_value',
        'offer_category_id'
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
        'offer_category_id' => 'integer'
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
        $rules['offer_category_id'] = 'required|integer';

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





    public function category()
    {
        return $this->belongsTo(OfferCategory::class, 'offer_category_id', 'id');
    }

}
