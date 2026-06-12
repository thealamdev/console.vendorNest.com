<?php

namespace Modules\ProductManagement\Actions\Category;

use Modules\ProductManagement\Models\Category;
use Modules\ProductManagement\Repositories\CategoryRepository;

class DeleteCategoryAction
{
    public function __construct(
        public CategoryRepository $repo
    ) {}

    public function execute(Category $category): bool
    {
        return $this->repo->delete($category);
    }
}
