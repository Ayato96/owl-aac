<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassword extends FormRequest
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
        'old_password_check' => 'The current password does not match.',
        'new_password_check' => 'The new password can not be the same with the current.',
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
        'current_password' => 'required|old_password_check',
        'new_password' => 'required|confirmed|min:7|max:32|alpha_dash|new_password_check',
        ];
    }
}
