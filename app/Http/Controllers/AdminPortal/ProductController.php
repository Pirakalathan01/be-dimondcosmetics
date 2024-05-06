<?php

namespace App\Http\Controllers\AdminPortal;

use App\Contracts\Services\AdminPortal\ProductServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPortal\Product\DeleteProductRequest;
use App\Http\Requests\AdminPortal\Product\StoreProductRequest;
use App\Http\Requests\AdminPortal\Product\UpdateProductRequest;
use App\Http\Resources\AdminPortal\Category\CategoryCollection;
use App\Http\Resources\AdminPortal\Product\ProductCollection;
use App\Http\Resources\AdminPortal\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): ProductCollection
    {
        return new ProductCollection($this->productService->paginate(
            $request->get('per_page', 15),
            [
                'id',
                'name',
                'description',
                'code',
                'category_id',
                'directions',
                'price',
                'in_stock',
            ]
        ));
    }

    public function all(Request $request): ProductCollection
    {
        return new ProductCollection($this->productService->all(
            [
                'id',
                'name',
                'description',
                'code',
                'category_id',
                'directions',
                'price',
                'in_stock',
            ]
        ));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        return response()->json([
            'message' => 'Product created successfully',
            'Product' => new ProductResource($this->productService->create($request->validated())),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $product): ProductResource
    {
        $product = $this->productService->find($product);
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $product): JsonResponse
    {
        $this->productService->update($product, $request->validated());
        return response()->json([
            'message' => 'Product updated successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteProductRequest $request, string $product): JsonResponse
    {
        $this->productService->delete($product);
        return response()->json([
            'message' => 'Product deleted successfully',
        ], 200);
    }
}
