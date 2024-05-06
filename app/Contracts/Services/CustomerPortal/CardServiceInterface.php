<?php

namespace App\Contracts\Services\CustomerPortal;


use App\Models\Card;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CardServiceInterface
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
     * @return Card
     */
    public function create(array $data): Card;

    /**
     * @param string $id
     * @return Card|null
     */
    public function find(string $id): ?Card;

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
