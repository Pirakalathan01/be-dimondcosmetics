<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Card;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Policies\AdminPolicy;
use App\Policies\CardPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\CustomerPolicy;
use App\Policies\OrderPolicy;
use App\Policies\ProductPolicy;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Admin::class => AdminPolicy::class,
        Customer::class => CustomerPolicy::class,
        Category::class => CategoryPolicy::class,
        Product::class => ProductPolicy::class,
        Order::class  => OrderPolicy::class,
        Card::class => CardPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole(config('role.admin')) ? true : null;
        });

        $this->registerPolicies();

        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        //
    }
}
