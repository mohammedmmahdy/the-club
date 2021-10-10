<?php

namespace App\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Meta;

class CreateMetaRequest extends FormRequest
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
        $languages = array_keys(config('langs'));

        foreach ($languages as $language) {
            $rules[$language . '.title'] = 'required|string|min:3|max:191';

            $rules[$language . '.description'] = 'required|min:3';

            $rules[$language . '.keywords'] = 'required|min:3';
        }


        $rules['page'] = 'required|string';

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            // 'page_id.unique' => 'This page is already in use, you can update its own resource'
        ];
    }
}
