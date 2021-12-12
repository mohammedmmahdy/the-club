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
class Gallery extends Model
{
    use ImageUploaderTrait;

    public $fillable = ['photo'];

    protected $casts = [
        'id' => 'integer',
        'photo' => 'string'
    ];

    public static $rules = [
        'photo' => 'required|image|mimes:jpeg,jpg,png',
    ];


    public function setPhotoAttribute($file)
    {
        if ($file) {
            try {
                $fileName = $this->createFileName($file);

                $this->originalImage($file, $fileName);

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

}
