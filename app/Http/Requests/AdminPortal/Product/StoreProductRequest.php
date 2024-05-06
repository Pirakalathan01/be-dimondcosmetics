<?php

namespace App\Http\Requests\AdminPortal\Product;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
            'description' => [
                'required',
                'string',
            ],
            'directions' => [
                'required',
                'string',
            ],
            'price' => [
                'required',
                'numeric',
            ],
            'in_stock' => [
                'required',
                'numeric',
            ],
//            'product_image' => [
//                'required',
//                'image',
//                'mimes:jpeg,png,jpg,gif',
////                'dimensions:width=240,height=125'
//            ],
        ];
    }
}
