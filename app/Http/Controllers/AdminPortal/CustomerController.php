<?php

namespace App\Http\Controllers\AdminPortal;


use App\Contracts\Services\AdminPortal\CustomerServiceInterface;
use App\Http\Controllers\Controller;

use App\Http\Resources\AdminPortal\Customer\CustomerResource;
use App\Http\Resources\CustomerPortal\Customer\CustomerCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{


    private CustomerServiceInterface $customerService;

    public function __construct(CustomerServiceInterface $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index(Request $request): CustomerCollection
    {
        return new CustomerCollection($this->customerService->paginate(
            $request->get('per_page', 15),
            [
                'id',
                'first_name',
                'last_name',
                'email',
                'phone_number',
                'is_active'
            ]
        ));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $customer): CustomerResource
    {
        $customer = $this->customerService->find($customer);
        return new CustomerResource($customer);
    }


}
