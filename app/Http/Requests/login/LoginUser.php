<?php

namespace App\Http\Requests\login;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LoginUser
 * @package App\Http\Requests\login
 */
class LoginUser extends FormRequest
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
        return
            [
                'name' => 'required|min:7|max:32|alpha_num|exists:accounts',
                'password' => 'required|min:7',
            ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'Account Name',
        ];
    }
}


