<?php

namespace App\Http\Requests\AdminPortal\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeleteProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $product = $this->route('product');
        $this->merge(['id' => $product]);
        return [
            'id' => [
                'required',
                Rule::exists('products')->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
        ];
    }

}
