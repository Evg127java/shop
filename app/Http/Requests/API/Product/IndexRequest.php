<?php

namespace App\Http\Requests\API\Product;

use http\Env\Response;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
            'categories' => 'nullable|array',
            'colors' => 'nullable|array',
            'tags' => 'nullable|array',
            'prices' => 'nullable|array',
            'sortOptions' => 'nullable|array',
            'page' => 'required|integer'
        ];
    }
}
