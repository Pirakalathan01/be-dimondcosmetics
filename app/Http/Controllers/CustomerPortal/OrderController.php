<?php

namespace App\Http\Controllers\CustomerPortal;

use App\Contracts\Services\CustomerPortal\OrderServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPortal\Order\UpdateOrderRequest;
use App\Http\Requests\CustomerPortal\Order\StoreOrderRequest;
use App\Http\Resources\CustomerPortal\Card\CardCollection;
use App\Http\Resources\CustomerPortal\Order\OrderCollection;
use App\Http\Resources\CustomerPortal\Order\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    private OrderServiceInterface $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): OrderCollection
    {
        return new OrderCollection($this->orderService->paginate(
            $request->get('per_page', 15),
            [
                'id',
                'identifier',
                'product_id',
                'customer_id',
                'order_status',
                'payment_type',
                'email',
                'first_name',
                'last_name',
                'address',
                'city',
                'country',
                'state',
                'post_code',
                'phone_number',
                'product_amount',
                'quantity',
                'shipping_amount',
                'total_gross_amount',
                'total_net_amount',
            ]
        ));
    }

    public function all(Request $request): OrderCollection
    {
        return new OrderCollection($this->orderService->all(
            [
                'id',
                'identifier',
                'product_id',
                'customer_id',
                'order_status',
                'payment_type',
                'email',
                'first_name',
                'last_name',
                'address',
                'city',
                'country',
                'state',
                'post_code',
                'phone_number',
                'product_amount',
                'quantity',
                'shipping_amount',
                'total_gross_amount',
                'total_net_amount',
            ]
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request): JsonResponse
    {
        return response()->json([
            'message' => 'Order created successfully',
            'Order' => new OrderResource($this->orderService->create($request->validated())),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $order): OrderResource
    {
        $order = $this->orderService->find($order);
        return new OrderResource($order);
    }

}
