<?php

namespace App\Repositories\CustomerPortal;

use App\Contracts\Repositories\CustomerPortal\ProductRepositoryInterface;
use App\Models\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    /**
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        $this->setModel($model);
    }

}
