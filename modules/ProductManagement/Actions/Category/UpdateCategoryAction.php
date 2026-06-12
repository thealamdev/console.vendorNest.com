<?php

namespace Modules\ProductManagement\Actions\Category;

use Modules\ProductManagement\DTOs\Category\UpdateCategoryData;
use Modules\ProductManagement\Models\Category;
use Modules\ProductManagement\Repositories\CategoryRepository;

class UpdateCategoryAction
{
    public function __construct(
        public CategoryRepository $repo
    ) {}

    public function execute(Category $category, UpdateCategoryData $data): Category
    {
        return $this->repo->update($category, $data);
    }
}
