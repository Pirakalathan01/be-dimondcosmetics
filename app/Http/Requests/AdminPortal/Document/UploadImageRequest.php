<?php

namespace App\Http\Requests\AdminPortal\Document;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'image' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'dimensions:width=470,height=600',
                'max:2048'
            ],
        ];
    }
}
