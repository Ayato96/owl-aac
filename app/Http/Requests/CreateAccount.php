<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAccount extends FormRequest
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
        'name.required' => 'The Account Name field is required.',
        'name.unique' => 'The Account Name has already been taken.',
        'name.min' => 'The Account Name must be at least :min characters.',
        'name.max' => 'The Account Name may not be greater than :max characters.',
        'name.alpha_num' => 'The Account Name may only contain letters and numbers.',
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
        'name' => 'required|min:7|max:32|alpha_num|unique:accounts',
        'email' => 'required|email|unique:accounts',
        'password' => 'required|confirmed|min:7|alpha_dash',
        'password_confirmation' => 'required',
        ];
    }
}