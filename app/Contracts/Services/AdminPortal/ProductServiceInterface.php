<?php

namespace App\Contracts\Services\AdminPortal;


use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductServiceInterface
{
    /**
     * @param array $columns
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection;

    /**
     * @param int $itemPerPage
     * @param array $columns
     * @return LengthAwarePaginator
     */
    public function paginate(int $itemPerPage = 15, array $columns = ['*']): LengthAwarePaginator;

    /**
     * @param array $data
     * @return Product
     */
    public function create(array $data): Product;

    /**
     * @param string $id
     * @return Product|null
     */
    public function find(string $id): ?Product;

    /**
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update(string $id, array $data): bool;

    /**
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool;

}
