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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5|max:32|unique:players|not_contains|character_name',
            'vocation' => 'required|integer|in:1,2,3,4',
            'town_id' => 'required|integer|in:1,2,3',
            'sex' => 'required|integer|in:0,1',
        ];
    }

    public function attributes()
    {
        return [
            'town_id' => 'Town',
        ];
    }
}
