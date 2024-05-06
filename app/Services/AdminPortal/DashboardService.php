<?php

namespace App\Services\AdminPortal;


use App\Contracts\Repositories\AdminPortal\CustomerRepositoryInterface;
use App\Contracts\Repositories\AdminPortal\OrderRepositoryInterface;
use App\Contracts\Repositories\AdminPortal\ProductRepositoryInterface;
use App\Contracts\Services\AdminPortal\DashboardServiceInterface;
use App\Http\Controllers\AdminPortal\CustomerController;
use App\Repositories\AdminPortal\CustomerRepository;
use App\Repositories\AdminPortal\ProductRepository;

class DashboardService implements DashboardServiceInterface
{


    private CustomerRepositoryInterface $customerRepository;
    private ProductRepositoryInterface $productRepository;
    private OrderRepositoryInterface $enrollmentRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository, ProductRepositoryInterface $productRepository, OrderRepositoryInterface $enrollmentRepository)
    {
        $this->customerRepository = $customerRepository;
        $this->productRepository = $productRepository;
        $this->enrollmentRepository = $enrollmentRepository;
    }

    public function overviewWidget(): array
    {
        return [
            [
                "label" => "Customers",
                "count" => $this->customerRepository->all()->count(),
            ],
            [
                "label" => "Products",
                "count" => $this->productRepository->all()->count(),
            ],
            [
                "label" => "Orders",
                "count" => $this->enrollmentRepository->all()->count(),
            ],
        ];
    }
}
