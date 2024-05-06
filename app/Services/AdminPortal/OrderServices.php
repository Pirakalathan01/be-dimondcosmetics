<?php

namespace App\Services\AdminPortal;

use App\Contracts\Repositories\AdminPortal\OrderRepositoryInterface;
use App\Contracts\Services\AdminPortal\OrderServiceInterface;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 *
 */
class OrderServices implements OrderServiceInterface
{
    /**
     * @var OrderRepositoryInterface
     */
    private OrderRepositoryInterface $orderRepository;

    /**
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @inheritDoc
     */
    public function all(array $columns = ['*']): Collection
    {
        return $this->orderRepository->all($columns);
    }

    /**
     * @inheritDoc
     */
    public function paginate(int $itemPerPage = 15, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->orderRepository->paginate($itemPerPage, $columns);
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): Order
    {
        return $this->orderRepository->create($data);
    }

    /**
     * @inheritDoc
     */
    public function find(string $id): ?Order
    {
        return $this->orderRepository->find($id);
    }

    /**
     * @param string $column
     * @param string $value
     * @return Order|null
     */
    public function findBy(string $column, string $value): ?Order
    {
        return $this->orderRepository->findBy($column, $value);
    }

    /**
     * @inheritDoc
     */
    public function update(string $id, array $data): bool
    {
        return $this->orderRepository->update($id, $data);
    }

    /**
     * @inheritDoc
     */
    public function delete(string $id): bool
    {
        return $this->orderRepository->delete($id);
    }
}
