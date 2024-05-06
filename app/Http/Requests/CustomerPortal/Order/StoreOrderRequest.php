<?php

namespace App\Http\Requests\CustomerPortal\Order;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
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
        $quantity = $this->input('quantity');
        return [
            'product_id' => [
                'required',
                Rule::exists('products', 'id')->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
                function ($attribute, $value, $fail) use ($quantity) {
                    $product = Product::find($value); // Assuming you have a Product model
                    if (!$product) {
                        $fail('Invalid product selected.');
                        return;
                    }
                    if ($quantity > $product->in_stock) {
                        $fail('The quantity is greater than available stock.');
                    }
                },
            ],
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
            ],
            'first_name' => [
                'required',
                'string',
                'max:255',
            ],
            'last_name' => [
                'required',
                'string',
                'max:255',
            ],
            'address' => [
                'required',
                'string',
                'max:255',
            ],
            'city' => [
                'required',
                'string',
                'max:255',
            ],
            'country' => [
                'required',
                'string',
                'max:255',
            ],
            'state' => [
                'required',
                'string',
                'max:255',
            ],
            'post_code' => [
                'required',
                'string',
                'max:255',
            ],
            'phone_number' => [
                'required',
                'string',
                'max:255',
            ],
            'quantity' => [
                'required',
                'numeric',
            ],

        ];
    }
}
