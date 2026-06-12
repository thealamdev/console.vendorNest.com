<?php

namespace Modules\ProductManagement\Services;

use Modules\ProductManagement\Actions\Category\DeleteCategoryAction;
use Modules\ProductManagement\Actions\Category\ListCategoryAction;
use Modules\ProductManagement\Actions\Category\ShowCategoryAction;
use Modules\ProductManagement\Actions\Category\StoreCategoryAction;
use Modules\ProductManagement\Actions\Category\UpdateCategoryAction;
use Modules\ProductManagement\DTOs\Category\StoreCategoryData;
use Modules\ProductManagement\DTOs\Category\UpdateCategoryData;
use Modules\ProductManagement\Models\Category;

class CategoryService
{
    public function __construct(
        public ListCategoryAction $listCategoryAction,
        public ShowCategoryAction $showCategoryAction,
        public StoreCategoryAction $storeCategoryAction,
        public UpdateCategoryAction $updateCategoryAction,
        public DeleteCategoryAction $deleteCategoryAction,
    ) {}

    public function getAll()
    {
        return $this->listCategoryAction->execute();
    }

    public function show(Category $category): Category
    {
        return $this->showCategoryAction->execute($category);
    }

    public function store(StoreCategoryData $data): Category
    {
        return $this->storeCategoryAction->execute($data);
    }

    public function update(Category $category, UpdateCategoryData $data): Category
    {
        return $this->updateCategoryAction->execute($category, $data);
    }

    public function delete(Category $category): bool
    {
        return $this->deleteCategoryAction->execute($category);
    }
}
