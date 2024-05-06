<?php

namespace App\Contracts\Services\AdminPortal;


use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrderServiceInterface
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
     * @return Order
     */
    public function create(array $data): Order;

    /**
     * @param string $id
     * @return Order|null
     */
    public function find(string $id): ?Order;

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
