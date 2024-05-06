<?php

namespace App\Http\Controllers\AdminPortal;

use App\Contracts\Services\AdminPortal\CategoryServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPortal\Category\DeleteCategoryRequest;
use App\Http\Requests\AdminPortal\Category\StoreCategoryRequest;
use App\Http\Requests\AdminPortal\Category\UpdateCategoryRequest;
use App\Http\Resources\AdminPortal\Category\CategoryCollection;
use App\Http\Resources\AdminPortal\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryServiceInterface $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): CategoryCollection
    {
        $this->authorize('viewAny', Category::class);
        return new CategoryCollection($this->categoryService->paginate(
            $request->get('per_page', 15),
            [
                'id',
                'name',
                'description'
            ]
        ));
    }

    public function all(Request $request): CategoryCollection
    {
        $this->authorize('viewAny', Category::class);
        return new CategoryCollection($this->categoryService->all(
            [
                'id',
                'name',
                'description'
            ]
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $this->authorize('create', Category::class);
        return response()->json([
            'message' => 'Category created successfully',
            'Category' => new CategoryResource($this->categoryService->create($request->validated())),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $category): CategoryResource
    {
        $category = $this->categoryService->find($category);
        $this->authorize('view', $category);
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $category): JsonResponse
    {
        $this->authorize('update',Category::class);
        $this->categoryService->update($category, $request->validated());
        return response()->json([
            'message' => 'Category updated successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteCategoryRequest $request, string $category): JsonResponse
    {
        $this->categoryService->delete($category);
        return response()->json([
            'message' => 'Category deleted successfully',
        ], 200);
    }
}
