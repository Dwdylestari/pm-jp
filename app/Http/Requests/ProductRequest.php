<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_name' => 'required|string|max:150',
            'product_weight' => 'required|string|max:50',
            'product_price' => 'required|integer',
            'product_stock' => 'required|integer',
            'product_product_category_uuid' => 'required',
            'product_img' => 'required|image|mimes:jpeg,png,jpg',
        ];  
    }
}
