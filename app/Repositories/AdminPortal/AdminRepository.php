<?php

namespace App\Repositories\AdminPortal;

use App\Contracts\Repositories\AdminPortal\AdminRepositoryInterface;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->setModel($model);
    }

    /**
     * @return Builder
     */
    public function queryBuilder(): Builder
    {
        return $this->model->query()->whereHas('roles', function ($query) {
            $query->where('name', '!=', config('role.customer'));
        });
    }

}
