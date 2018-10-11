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
            'password' => 'required|confirmed|min:7|max:32|alpha_dash',
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('words.account_name'),
        ];
    }
}
