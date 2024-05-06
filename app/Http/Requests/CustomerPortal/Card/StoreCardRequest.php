<?php

namespace App\Http\Requests\CustomerPortal\Card;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCardRequest extends FormRequest
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
        $customerId = auth()->user()->id;
        $this->merge(['customer_id' => $customerId]);
        return [
            'customer_id' => [
                'required',
                'string',
                'max:255',
                Rule::exists('users', 'id')->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
            'product_id' => [
                'required',
                'string',
                'max:255',
                Rule::exists('products', 'id')->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
                Rule::unique('cards','product_id')->where(function ($query) use($customerId) {
                    $query->where('customer_id', $customerId);
                }),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.unique' => 'The selected product is already assigned to cards.',
        ];
    }
}
