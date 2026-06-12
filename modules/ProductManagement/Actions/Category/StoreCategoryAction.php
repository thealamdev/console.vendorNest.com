<?php

namespace Modules\ProductManagement\Actions\Category;

use Modules\ProductManagement\DTOs\Category\StoreCategoryData;
use Modules\ProductManagement\Models\Category;
use Modules\ProductManagement\Repositories\CategoryRepository;

class StoreCategoryAction
{
    public function __construct(
        public CategoryRepository $repo
    ) {}

    public function execute(StoreCategoryData $data): Category
    {
        return $this->repo->store($data);
    }
}
