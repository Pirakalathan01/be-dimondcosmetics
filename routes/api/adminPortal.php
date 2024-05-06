<?php

use App\Http\Controllers\AdminPortal\CategoryController;
use App\Http\Controllers\AdminPortal\CustomerController;
use App\Http\Controllers\AdminPortal\DashboardController;
use App\Http\Controllers\AdminPortal\OrderController;
use App\Http\Controllers\AdminPortal\ProductController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::prefix('admin')->group(function (Router $route) {
        //Dashboard
        $route->get('dashboard/overview-widget', [DashboardController::class, 'overviewWidget']);

        // Admins
        $route->get('customers', [CustomerController::class, 'index']);
        $route->get('customers/{customer}', [CustomerController::class, 'show']);

        // Categories
        $route->get('categories/all', [CategoryController::class, 'all']);
        $route->apiResource('categories', CategoryController::class);

        // Products
        $route->get('products/all', [ProductController::class, 'all']);
        $route->apiResource('products', ProductController::class);

        // Orders
        $route->get('orders/all', [OrderController::class, 'all']);
        $route->apiResource('orders', OrderController::class);

    });

});

