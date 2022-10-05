<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|unique:products',
            'description' => 'required|string',
            'content' => 'required|string',
            'preview_image' => 'nullable|file|image',
            'price' => 'required|integer',
            'count' => 'required|integer',
            'category_id' => 'required|integer',
            'is_published' => 'nullable|integer',
            'tags' => 'nullable|array',
            'colors' => 'nullable|array',
            'product_images' => 'nullable|array',
            'product_images.*' => 'nullable|file|image'
        ];
    }
}
