<?php

namespace App\Services\AdminPortal;

use App\Contracts\Repositories\AdminPortal\CategoryRepositoryInterface;
use App\Contracts\Services\AdminPortal\CategoryServiceInterface;
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
    public function create(array $data): Category
    {
        return $this->categoryRepository->create($data);
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

    /**
     * @inheritDoc
     */
    public function update(string $id, array $data): bool
    {
        return $this->categoryRepository->update($id, $data);
    }

    /**
     * @inheritDoc
     */
    public function delete(string $id): bool
    {
        return $this->categoryRepository->delete($id);
    }
}
