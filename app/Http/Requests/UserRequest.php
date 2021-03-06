<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'lastName' => 'required|string',
            'firstName' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
            'telephoneNumber' => 'required|integer',
            'role_id' => 'required|integer'
        ];
    }
}
