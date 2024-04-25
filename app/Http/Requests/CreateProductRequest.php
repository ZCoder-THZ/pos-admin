<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'productName' => 'required|min:5',
            'productPrice' => 'required',
            'productDescription' => 'required',
            // 'productImage' => 'required',
            'categoryId' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'productName.required' => 'Product name is required.',
            'productName.min' => 'Product name must be at least 5 characters.',
            'productPrice.required' => 'Product price is required.',
            'productDescription.required' => 'Product description is required.',
            'productImage.required' => 'Product image is required.',
            'categoryId.required' => 'Category is required.',
        ];
    }
}
