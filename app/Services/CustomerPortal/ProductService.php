<?php

namespace App\Services\CustomerPortal;

use App\Contracts\Repositories\CustomerPortal\ProductRepositoryInterface;
use App\Contracts\Services\CustomerPortal\ProductServiceInterface;
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
}
