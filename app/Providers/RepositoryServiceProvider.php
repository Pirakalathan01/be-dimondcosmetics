<?php

namespace App\Providers;

use App\Contracts\Repositories\AdminPortal\AdminRepositoryInterface;
use App\Contracts\Repositories\AdminPortal\CategoryRepositoryInterface;
use App\Contracts\Repositories\AdminPortal\CustomerRepositoryInterface;
use App\Contracts\Repositories\AdminPortal\OrderRepositoryInterface;
use App\Contracts\Repositories\AdminPortal\ProductRepositoryInterface;
use App\Contracts\Repositories\CustomerPortal\CardRepositoryInterface;
use App\Contracts\Repositories\Role\RoleRepositoryInterface;
use App\Contracts\Repositories\User\UserRepositoryInterface;
use App\Contracts\Services\AdminPortal\AdminServiceInterface;
use App\Contracts\Services\AdminPortal\CategoryServiceInterface;
use App\Contracts\Services\AdminPortal\CustomerServiceInterface;
use App\Contracts\Services\AdminPortal\DashboardServiceInterface;
use App\Contracts\Services\AdminPortal\OrderServiceInterface;
use App\Contracts\Services\AdminPortal\ProductServiceInterface;
use App\Contracts\Services\CustomerPortal\CardServiceInterface;
use App\Contracts\Services\Role\RoleServiceInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Repositories\AdminPortal\AdminRepository;
use App\Repositories\AdminPortal\CategoryRepository;
use App\Repositories\AdminPortal\CustomerRepository;
use App\Repositories\AdminPortal\OrderRepository;
use App\Repositories\AdminPortal\ProductRepository;
use App\Repositories\CustomerPortal\CardRepository;
use App\Repositories\Role\RoleRepository;
use App\Repositories\User\UserRepository;
use App\Services\AdminPortal\AdminService;
use App\Services\AdminPortal\CategoryService;
use App\Services\AdminPortal\CustomerService;
use App\Services\AdminPortal\DashboardService;
use App\Services\AdminPortal\OrderServices;
use App\Services\AdminPortal\ProductService;
use App\Services\CustomerPortal\CardServices;
use App\Services\Role\RoleService;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        $this->app->bind(RoleServiceInterface::class, RoleService::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);

        $this->app->bind(DashboardServiceInterface::class, DashboardService::class);

        $this->app->bind(AdminServiceInterface::class, AdminService::class);
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(CustomerServiceInterface::class, CustomerService::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(OrderServiceInterface::class, OrderServices::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);


        $this->app->bind(\App\Contracts\Services\CustomerPortal\CustomerServiceInterface::class, \App\Services\CustomerPortal\CustomerService::class);
        $this->app->bind(\App\Contracts\Repositories\CustomerPortal\CustomerRepositoryInterface::class, \App\Repositories\CustomerPortal\CustomerRepository::class);
        $this->app->bind(\App\Contracts\Services\CustomerPortal\CategoryServiceInterface::class, \App\Services\CustomerPortal\CategoryService::class);
        $this->app->bind(\App\Contracts\Repositories\CustomerPortal\CategoryRepositoryInterface::class, \App\Repositories\CustomerPortal\CategoryRepository::class);
        $this->app->bind(\App\Contracts\Services\CustomerPortal\ProductServiceInterface::class, \App\Services\CustomerPortal\ProductService::class);
        $this->app->bind(\App\Contracts\Repositories\CustomerPortal\ProductRepositoryInterface::class, \App\Repositories\CustomerPortal\ProductRepository::class);
        $this->app->bind(CardServiceInterface::class, CardServices::class);
        $this->app->bind(CardRepositoryInterface::class, CardRepository::class);
        $this->app->bind(\App\Contracts\Services\CustomerPortal\OrderServiceInterface::class, \App\Services\CustomerPortal\OrderServices::class);
        $this->app->bind(\App\Contracts\Repositories\CustomerPortal\OrderRepositoryInterface::class, \App\Repositories\CustomerPortal\OrderRepository::class);

    }

    public function boot(): void
    {
        //
    }

}
