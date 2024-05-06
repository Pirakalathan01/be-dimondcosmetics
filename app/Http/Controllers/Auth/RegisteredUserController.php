<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Services\Role\RoleServiceInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterCustomerRequest;
use App\Http\Resources\CustomerPortal\Customer\CustomerResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function __construct(UserServiceInterface $userService, RoleServiceInterface $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterCustomerRequest $request): JsonResponse
    {

        $customer = $this->userService->create($request->validated());
        $customerRole = $this->roleService->findBy('name', config('role.customer'));
        $customer->assignRole($customerRole);
        $customer->markEmailAsVerified();
//        event(new Registered($student));

//        Auth::login($student);

        return response()->json([
            'message' => 'Student Registered successfully',
            'Student' => new CustomerResource($customer),
        ], 201);
    }
}
