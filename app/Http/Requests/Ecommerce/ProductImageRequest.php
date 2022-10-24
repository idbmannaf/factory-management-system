<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ProductImageRequest extends FormRequest
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

    protected function failedValidation(Validator $validator)
    {
        return response()->json($validator->errors());
        parent::failedValidation($validator);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'required|image|max:512',
        ];
    }
    public function messages()
    {
        return [
            'image.required' => 'Product image is required',
            'image.image' => 'Product image should be an image file',
            'image.max' => 'Product image should be of 512KB maximum',
        ];
    }
}
