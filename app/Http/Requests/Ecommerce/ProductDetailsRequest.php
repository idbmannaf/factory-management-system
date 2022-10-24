<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;

class ProductDetailsRequest extends FormRequest
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
            'description' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Product Name is required',
            'name.max' => 'Product Name can not be more than 225 characters.',
            'description.required' => 'Product Description is required',
            'category.required' => 'Please select a category',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price should be numeric',
        ];
    }
}
