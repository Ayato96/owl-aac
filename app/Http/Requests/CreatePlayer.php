<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePlayer extends FormRequest
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

    public function messages()
    {
        return [
        'not_contains' => 'The :attribute must not contain banned words.',
        'character_name' => 'The :attribute contains illegal letters or reserved words.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'name' => 'required|min:5|max:32|unique:players|not_contains|character_name',
        'vocation' => 'required|between:1,4',
        'town_id' => 'required|between:1,3',
        'sex' => 'required|between:0,1',
        ];
    }
}
