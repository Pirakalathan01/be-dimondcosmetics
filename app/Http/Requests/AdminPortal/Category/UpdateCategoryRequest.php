<?php

namespace App\Http\Requests\AdminPortal\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
        $category = $this->route('category');
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Category::class)->where(function ($query) {
                    $query->whereNull('deleted_at');
                })->ignore($category),
            ],
            'description' => [
                'required',
                'string',
            ],
        ];
    }
}
