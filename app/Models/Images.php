<?php

namespace App\Models;

use App\Helpers\ImageUploaderTrait;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class images
 * @package App\Models
 * @version September 27, 2020, 12:25 pm UTC
 *
 * @property integer $page_id
 * @property string $photo
 */
class Images extends Model
{
    use SoftDeletes, ImageUploaderTrait;

    public $table = 'images';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'page_id',
        'photo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'page_id' => 'integer',
        'photo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'photo' => 'required|image|mimes:jpeg,jpg,png',
    ];



    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;



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


    public function getPhotoAttribute($val)
    {
        return $val ? asset('uploads/images/original') . '/' . $val : null;
    }

    // Relations

    public function page()
    {
        return $this->belongsTo('App\Models\Page', 'page_id', 'id');
    }
}
