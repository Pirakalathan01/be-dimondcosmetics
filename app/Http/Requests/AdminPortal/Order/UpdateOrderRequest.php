<?php

namespace App\Http\Requests\AdminPortal\Order;

use App\Enums\OrderStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrderRequest extends FormRequest
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
        return [
            'order_status' => [
                'required',
                'string',
                Rule::in([OrderStatus::Order_Placed, OrderStatus::Cancelled. OrderStatus::Delivered, OrderStatus::Processing, OrderStatus::Shipped]),
            ],
        ];
    }
}
