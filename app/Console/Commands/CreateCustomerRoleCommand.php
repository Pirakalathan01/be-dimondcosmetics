<?php

namespace App\Console\Commands;

use App\Models\RoleAndPermission\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class CreateCustomerRoleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customer:role:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create customer role';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $role = Role::firstOrCreate([
                'name' => config('role.customer'),
            ]
        );

        $role->revokePermissionTo(Permission::all());

        $permissions = Permission::where('model', 'Customers')
            ->whereIn('name', [
                'customers-viewany',
                'customers-view',
                'customers-create',
                'customers-update',
                'customers-delete',
            ])->get();
        $this->givePermissions($role, $permissions);

        $permissions = Permission::where('model', 'Products')
            ->whereIn('name', [
                'products-viewany',
                'products-view',
            ])->get();
        $this->givePermissions($role, $permissions);

        $permissions = Permission::where('model', 'Categories')
            ->whereIn('name', [
                'categories-viewany',
                'categories-view',
            ])->get();
        $this->givePermissions($role, $permissions);

        $permissions = Permission::where('model', 'Orders')
            ->whereIn('name', [
                'orders-viewany',
                'orders-view',
                'orders-create',
                'orders-update',
                'orders-delete',
            ])->get();
        $this->givePermissions($role, $permissions);

        $permissions = Permission::where('model', 'Cards')
            ->whereIn('name', [
                'cards-viewany',
                'cards-view',
                'cards-create',
                'cards-update',
                'cards-delete',
            ])->get();
        $this->givePermissions($role, $permissions);


        $this->info('Customer role created successfully!');
    }

    private function givePermissions($role, $permissions)
    {
        foreach ($permissions as $permission)
        {
            $role->givePermissionTo($permission);
        }
    }

}
