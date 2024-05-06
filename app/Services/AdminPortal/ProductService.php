<?php

namespace App\Services\AdminPortal;

use App\Contracts\Repositories\AdminPortal\ProductRepositoryInterface;
use App\Contracts\Services\AdminPortal\ProductServiceInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 *
 */
class ProductService implements ProductServiceInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private ProductRepositoryInterface $productRepository;

    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @inheritDoc
     */
    public function all(array $columns = ['*']): Collection
    {
        return $this->productRepository->all($columns);
    }

    /**
     * @inheritDoc
     */
    public function paginate(int $itemPerPage = 15, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->productRepository->paginate($itemPerPage, $columns);
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): Product
    {
        return $this->productRepository->create($data);
    }

    /**
     * @inheritDoc
     */
    public function find(string $id): ?Product
    {
        return $this->productRepository->find($id);
    }

    /**
     * @param string $column
     * @param string $value
     * @return Product|null
     */
    public function findBy(string $column, string $value): ?Product
    {
        return $this->productRepository->findBy($column, $value);
    }

    /**
     * @inheritDoc
     */
    public function update(string $id, array $data): bool
    {
        return $this->productRepository->update($id, $data);
    }

    /**
     * @inheritDoc
     */
    public function delete(string $id): bool
    {
        return $this->productRepository->delete($id);
    }
}
