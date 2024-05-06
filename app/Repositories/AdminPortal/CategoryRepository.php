<?php

namespace App\Repositories\AdminPortal;

use App\Contracts\Repositories\AdminPortal\CategoryRepositoryInterface;
use App\Models\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * @param Category $model
     */
    public function __construct(Category $model)
    {
        $this->setModel($model);
    }

}
