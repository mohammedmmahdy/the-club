<?php

namespace App\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Option;

class UpdateOptionRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules                  = Option::$rules;
        $rules['logo']          = 'nullable';
        $rules['fav_icon']      = 'nullable';
        $rules['welcome_photo'] = 'nullable';

        return $rules;
    }
}
