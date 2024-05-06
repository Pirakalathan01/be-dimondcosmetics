<?php

namespace App\Http\Resources\CustomerPortal\Card;

use App\Http\Resources\CustomerPortal\Product\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product' => new ProductResource($this->product)
        ];
    }

}
