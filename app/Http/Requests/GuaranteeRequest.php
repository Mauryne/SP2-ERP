<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuaranteeRequest extends FormRequest
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
            'initialDuration' => 'required|integer',
            'device_id' => 'required|integer'
        ];
    }
}
