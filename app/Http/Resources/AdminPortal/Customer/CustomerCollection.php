<?php

namespace App\Http\Resources\AdminPortal\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomerCollection extends ResourceCollection
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
