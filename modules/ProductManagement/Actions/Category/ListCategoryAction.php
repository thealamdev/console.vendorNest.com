<?php

namespace Modules\ProductManagement\Actions\Category;

use Modules\ProductManagement\Repositories\CategoryRepository;

class ListCategoryAction
{
    public function __construct(
        public CategoryRepository $repo
    ) {}

    public function execute()
    {
        return $this->repo->getAll();
    }
}
