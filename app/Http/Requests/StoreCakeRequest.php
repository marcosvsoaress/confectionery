<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCakeRequest extends FormRequest
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
            'name' => 'required|max:255',
            'weight' => [
                'required',
                'numeric',
                'between:0,99.999',
                'regex:/^[0-9]\d{0,1}(?:\.\d{1,3})?$/'
            ],
            'price' => [
                'required',
                'numeric',
                'between:0,99999999.99',
                'regex:/^[0-9]\d{0,7}(?:\.\d{1,2})?$/',
            ],
            'quantity' => 'required|integer|min:0'
        ];
    }
}
