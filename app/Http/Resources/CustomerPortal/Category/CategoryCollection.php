<?php

namespace App\Http\Resources\CustomerPortal\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 *
 */
class CategoryCollection extends ResourceCollection
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
