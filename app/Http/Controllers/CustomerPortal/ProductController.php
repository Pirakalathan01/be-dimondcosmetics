<?php

namespace App\Http\Controllers\CustomerPortal;

use App\Contracts\Services\CustomerPortal\ProductServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerPortal\Product\ProductCollection;
use App\Http\Resources\CustomerPortal\Product\ProductResource;
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
     * Display the specified resource.
     */
    public function show(string $product): ProductResource
    {
        $product = $this->productService->find($product);
        return new ProductResource($product);
    }

}
