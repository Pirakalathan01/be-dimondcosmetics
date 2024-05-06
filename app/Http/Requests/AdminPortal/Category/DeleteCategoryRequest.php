<?php

namespace App\Http\Requests\AdminPortal\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeleteCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $category = $this->route('category');
        $this->merge(['id' => $category]);
        return [
            'id' => [
                'required',
                Rule::exists('categories')->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
        ];
    }

}
