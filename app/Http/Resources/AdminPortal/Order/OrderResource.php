<?php

namespace App\Http\Resources\AdminPortal\Order;

use App\Http\Resources\AdminPortal\Customer\CustomerResource;
use App\Http\Resources\AdminPortal\Product\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'identifier' => $this->identifier,
            'product_id' => $this->product_id,
            'product' => new ProductResource($this->product),
            'customer_id' => $this->customer_id,
            'customer' => new CustomerResource($this->customer),
            'status' => $this->order_status,
            'payment_type' => $this->payment_type,
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'address' => $this->address,
            'city' => $this->city,
            'country' => $this->country,
            'state' => $this->state,
            'post_code' => $this->post_code,
            'phone_number' => $this->phone_number,
            'product_amount' => $this->product_amount,
            'quantity' => $this->quantity,
            'shipping_amount' => $this->shipping_amount,
            'total_gross_amount' => $this->total_gross_amount,
            'total_net_amount' => $this->total_net_amount,
        ];
    }

}
