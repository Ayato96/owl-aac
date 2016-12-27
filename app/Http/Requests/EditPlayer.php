<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Player;

class EditPlayer extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $player = Player::find($this->route('id'));

        return $player && $this->user()->can('update', $player);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'description' => 'max:200',
        ];
    }
}
