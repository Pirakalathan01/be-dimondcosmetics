<?php

namespace App\Http\Requests\CustomerPortal\Card;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeleteCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $card = $this->route('card');
        $this->merge(['id' => $card]);
        return [
            'id' => [
                'required',
                Rule::exists('cards'),
            ],
        ];
    }

}
