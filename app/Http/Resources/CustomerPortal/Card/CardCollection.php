<?php

namespace App\Http\Resources\CustomerPortal\Card;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CardCollection extends ResourceCollection
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
