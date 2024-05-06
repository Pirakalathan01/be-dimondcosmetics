<?php

namespace App\Http\Resources\AdminPortal\Product;

use App\Http\Resources\AdminPortal\Category\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'code' => $this->code,
            'category_id' => $this->category_id,
            'category' => new CategoryResource($this->category),
            'directions' => $this->directions,
            'price' => $this->price,
            'in_stock' => $this->in_stock,
        ];
    }

}
