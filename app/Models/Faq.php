<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Faq
 * @package App\Models
 * @version December 8, 2020, 3:10 pm UTC
 *
 * @property string $question
 * @property string $answer
 */
class Faq extends Model
{
    use SoftDeletes, Translatable;

    public $table = 'faqs';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'faq_category_id',
        // 'question',
        // 'answer'
    ];

    protected $casts = [
        'id' => 'integer',
        'question' => 'string',
        'answer' => 'string'
    ];

    public $translatedAttributes =  ['question', 'answer'];

    public static function rules()
    {
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.question'] = 'required|string|min:3|max:191';
            $rules[$language . '.answer'] = 'required|string|min:3';
        }
        $rules['faq_category_id'] = 'required';

        return $rules;
    }
}
