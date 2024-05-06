<?php

namespace App\Http\Controllers\CustomerPortal;


use App\Contracts\Services\CustomerPortal\CustomerServiceInterface;
use App\Http\Controllers\Controller;


use App\Http\Requests\CustomerPortal\Customer\UpdateCustomerRequest;
use App\Http\Resources\CustomerPortal\Customer\CustomerResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{


    private CustomerServiceInterface $customerService;

    public function __construct(CustomerServiceInterface $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $customer): CustomerResource
    {
        $customer = $this->customerService->find($customer);
        return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, string $customer): JsonResponse
    {
        $this->customerService->update($customer, $request->validated());
        return response()->json([
            'message' => 'Customer updated successfully',
        ], 200);
    }

}
