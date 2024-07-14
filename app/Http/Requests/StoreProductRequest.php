<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
          
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Product Name',
            'description' => 'Product Description',
            'price' => 'Product Price',
            'stock' => 'Product Stock',
            'category_id' => 'Category',
            'image' => 'Product Image',
        ];
    }
}
