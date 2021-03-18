<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeviceRequest extends FormRequest
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
            'serialNumber' => 'required',
            'productReference' => 'required',
            'europeanNormPicture' => 'mimes:jpg,png,jpeg|max:5048',
            'installationPicture' => 'mimes:jpg,png,jpeg|max:5048',
            'saleDate' => 'date_format:Y-m-d',
            'installation_id' => 'integer',
            'type_id' => 'required|integer',
            'customer_id' => 'integer',
            'europeanNorm_id' => 'integer',
            'contract_id' => 'integer',
        ];
    }
}
