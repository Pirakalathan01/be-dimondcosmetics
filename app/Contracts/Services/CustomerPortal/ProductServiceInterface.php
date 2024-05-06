<?php

namespace App\Contracts\Services\CustomerPortal;


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
     * @param string $id
     * @return Product|null
     */
    public function find(string $id): ?Product;



}
