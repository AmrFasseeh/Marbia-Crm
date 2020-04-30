<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdate extends FormRequest
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
            'id' => 'integer',
            'username' => 'required|string',
            'first_name' => 'string',
            'last_name' => 'string',
            'password' => 'confirmed',
            'email' => 'required|email',
            'user_type' => 'string',
            'status' => 'boolean'

        ];
    }
}
