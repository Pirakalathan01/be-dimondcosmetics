<?php

namespace App\Http\Requests\AdminPortal\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeleteCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $customer = $this->route('customer');
        $this->merge(['id' => $customer]);
        return [
            'id' => [
                'required',
                Rule::exists('users')->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
        ];
    }

}
