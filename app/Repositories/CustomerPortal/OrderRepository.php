<?php

namespace App\Repositories\CustomerPortal;

use App\Contracts\Repositories\CustomerPortal\OrderRepositoryInterface;
use App\Models\Order;
use App\Repositories\BaseRepository;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    /**
     * @param Order $model
     */
    public function __construct(Order $model)
    {
        $this->setModel($model);
    }


}
