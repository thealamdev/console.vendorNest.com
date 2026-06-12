<?php

namespace Modules\ProductManagement\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Modules\ProductManagement\DTOs\Category\StoreCategoryData;
use Modules\ProductManagement\DTOs\Category\UpdateCategoryData;
use Modules\ProductManagement\Models\Category;

class CategoryRepository
{
    public function getAll(): Collection
    {
        return Category::query()
            ->select('id', 'parent_id', 'name', 'slug', 'status')
            ->with('parent:id,name,slug')
            ->orderBy('name')
            ->get();
    }

    public function show(Category $category): Category
    {
        return $category->load('parent:id,name,slug');
    }

    public function store(StoreCategoryData $data): Category
    {
        $category = Category::create([
            'parent_id'  => $data->parent_id,
            'name'       => $data->name,
            'slug'       => Str::slug($data->name),
            'status'     => $data->status,
        ]);

        return $category->load('parent:id,name,slug');
    }

    public function update(Category $category, UpdateCategoryData $data): Category
    {
        $category->update([
            'parent_id'  => $data->parent_id,
            'name'       => $data->name,
            'slug'       => Str::slug($data->name),
            'status'     => $data->status,
        ]);

        return $category->load('parent:id,name,slug');
    }

    public function delete(Category $category): bool
    {
        return (bool) $category->delete();
    }
}
