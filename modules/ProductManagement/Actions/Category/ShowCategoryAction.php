<?php

namespace Modules\ProductManagement\Actions\Category;

use Modules\ProductManagement\Models\Category;
use Modules\ProductManagement\Repositories\CategoryRepository;

class ShowCategoryAction
{
    public function __construct(
        public CategoryRepository $repo
    ) {}

    public function execute(Category $category): Category
    {
        return $this->repo->show($category);
    }
}
