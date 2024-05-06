<?php

namespace App\Services\CustomerPortal;

use App\Contracts\Repositories\CustomerPortal\OrderRepositoryInterface;
use App\Contracts\Services\CustomerPortal\OrderServiceInterface;
use App\Enums\OrderStatus;
use App\Enums\PaymentType;
use App\Models\Order;
use App\Repositories\CustomerPortal\ProductRepository;
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
    private ProductRepository $productRepository;

    /**
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(OrderRepositoryInterface $orderRepository, ProductRepository $productRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
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
        $data['customer_id'] = auth()->user()->id;
        $data['order_status'] = OrderStatus::Order_Placed;
        $data['payment_type'] = PaymentType::cash_on_delivery;
        $data['shipping_amount'] = 300.00;

        $product = $this->productRepository->find($data['product_id']);

        $product_price = $product->price;
        $total_gross_amount = (int)$data['quantity'] * (float)$product_price;
        $total_net_amount = $total_gross_amount + $data['shipping_amount'];
        $data['product_amount'] = $product_price;
        $data['total_gross_amount'] = $total_gross_amount;
        $data['total_net_amount'] = $total_net_amount;

        $currentQuantity = $product->in_stock;
        $finalQuantity = $currentQuantity - (int)$data['quantity'];

        $product->in_stock = $finalQuantity;
        $product->save();

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

}
