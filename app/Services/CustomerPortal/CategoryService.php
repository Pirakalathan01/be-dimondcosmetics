<?php

namespace App\Services\CustomerPortal;

use App\Contracts\Repositories\CustomerPortal\CategoryRepositoryInterface;
use App\Contracts\Services\CustomerPortal\CategoryServiceInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 *
 */
class CategoryService implements CategoryServiceInterface
{
    /**
     * @var CategoryRepositoryInterface
     */
    private CategoryRepositoryInterface $categoryRepository;

    /**
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @inheritDoc
     */
    public function all(array $columns = ['*']): Collection
    {
        return $this->categoryRepository->all($columns);
    }

    /**
     * @inheritDoc
     */
    public function paginate(int $itemPerPage = 15, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->categoryRepository->paginate($itemPerPage, $columns);
    }

    /**
     * @inheritDoc
     */
    public function find(string $id): ?Category
    {
        return $this->categoryRepository->find($id);
    }

    /**
     * @param string $column
     * @param string $value
     * @return Category|null
     */
    public function findBy(string $column, string $value): ?Category
    {
        return $this->categoryRepository->findBy($column, $value);
    }

}
