<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

/**
 *
 */
class RegisterCustomerRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [

            'first_name' => [
                'required',
                'string',
                'max:255'
            ],
            'last_name' => [
                'required',
                'string',
                'max:255'
            ],
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                Rule::unique(User::class)->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
            'phone_number' => [
                'nullable',
                'numeric',
                'min_digits:10',
                Rule::unique(User::class)->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
            'password' => [
                'nullable',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                'confirmed'
            ]

        ];
    }

}
