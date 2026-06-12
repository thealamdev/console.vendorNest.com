<?php

namespace Modules\ProductManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Support\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Modules\ProductManagement\DTOs\Category\StoreCategoryData;
use Modules\ProductManagement\DTOs\Category\UpdateCategoryData;
use Modules\ProductManagement\Http\Requests\StoreCategoryRequest;
use Modules\ProductManagement\Http\Requests\UpdateCategoryRequest;
use Modules\ProductManagement\Http\Resources\Category\ListCategoryResource;
use Modules\ProductManagement\Http\Resources\Category\StoreCategoryResource;
use Modules\ProductManagement\Models\Category;
use Modules\ProductManagement\Services\CategoryService;

class CategoryController extends Controller
{
    public function __construct(
        public CategoryService $service
    ) {}

    public function index(): JsonResponse
    {
        Gate::authorize('viewAny', Category::class);
        $response = $this->service->getAll();

        return ApiResponse::success(
            data: ListCategoryResource::collection($response),
            message: 'Category get successfully'
        );
    }

    public function show(Category $category): JsonResponse
    {
        Gate::authorize('view', $category);
        $response = $this->service->show($category);

        return ApiResponse::success(
            data: new StoreCategoryResource($response),
            message: 'Category details get successfully'
        );
    }

    public function store(StoreCategoryRequest $request): JsonResponse
    {
        Gate::authorize('create', Category::class);
        try {
            $data = StoreCategoryData::make($request);
            $response = $this->service->store($data);

            return ApiResponse::success(
                data: new StoreCategoryResource($response),
                message: 'Category created successfully'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                message: $e->getMessage(),
                errors: $e
            );
        }
    }

    public function update(Category $category, UpdateCategoryRequest $request): JsonResponse
    {
        Gate::authorize('update', $category);
        try {
            $data = UpdateCategoryData::make($request);
            $response = $this->service->update($category, $data);

            return ApiResponse::success(
                data: new StoreCategoryResource($response),
                message: 'Category updated successfully'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                message: $e->getMessage(),
                errors: $e
            );
        }
    }

    public function destroy(Category $category): JsonResponse
    {
        Gate::authorize('delete', $category);
        try {
            $response = $this->service->delete($category);

            return ApiResponse::success(
                data: ['deleted' => $response],
                message: 'Category deleted successfully'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                message: $e->getMessage(),
                errors: $e
            );
        }
    }
}