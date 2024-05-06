<?php

namespace App\Repositories\AdminPortal;

use App\Contracts\Repositories\AdminPortal\OrderRepositoryInterface;
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
