<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Setting;

/**
 * Class Install
 * @package App\Http\Requests
 */
class Install extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Setting::get('server.installed')) {
            return false;
        }
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
            'path' => 'required|check_config_lua',
            'name' => 'required|min:7|max:32|alpha_num',
            'password' => 'required|min:7|max:32|alpha_dash',
        ];
    }
}
