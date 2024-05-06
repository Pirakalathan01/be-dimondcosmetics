<?php

use App\Http\Controllers\CustomerPortal\CardController;
use App\Http\Controllers\CustomerPortal\CustomerController;
use App\Http\Controllers\CustomerPortal\OrderController;
use App\Http\Controllers\CustomerPortal\ProductController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum',])->group(function () {

    Route::prefix('web')->group(function (Router $route) {
        // Customers
        $route->get('customers/{customer}', [CustomerController::class, 'show']);
        $route->put('customers/{customer}', [CustomerController::class, 'update']);

        // Categories
        $route->get('cards/all', [CardController::class, 'all']);
        $route->apiResource('cards', CardController::class);

        // Orders
        $route->get('orders/all', [OrderController::class, 'all']);
        $route->apiResource('orders', OrderController::class);

    });

});


Route::prefix('web')->group(function (Router $route) {
    // Products
    $route->get('products/all', [ProductController::class, 'all']);
    $route->get('products', [ProductController::class, 'index']);
    $route->get('products/{product}', [ProductController::class, 'show']);
});
