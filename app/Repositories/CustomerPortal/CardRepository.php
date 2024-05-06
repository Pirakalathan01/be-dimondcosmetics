<?php

namespace App\Repositories\CustomerPortal;

use App\Contracts\Repositories\CustomerPortal\CardRepositoryInterface;
use App\Models\Card;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class CardRepository extends BaseRepository implements CardRepositoryInterface
{
    /**
     * @param Card $model
     */
    public function __construct(Card $model)
    {
        $this->setModel($model);
    }

    public function queryBuilder(): Builder
    {
        return $this->model->where('customer_id', auth()->user()->id);
    }

}
