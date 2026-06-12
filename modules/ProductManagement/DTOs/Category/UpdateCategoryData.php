<?php

namespace Modules\ProductManagement\DTOs\Category;

use Modules\ProductManagement\Http\Requests\UpdateCategoryRequest;

readonly class UpdateCategoryData
{
    public function __construct(
        public ?string $parent_id = null,
        public string $name = '',
        public bool $status = true
    ) {}

    public static function make(UpdateCategoryRequest $request): self
    {
        return new self(
            parent_id: $request->input('parent_id'),
            name: $request->input('name'),
            status: $request->boolean('status')
        );
    }
}
