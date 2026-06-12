<?php

namespace Modules\ProductManagement\Http\Resources\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'parent_id' => $this->parent_id,
            'parent'    => $this->parentInfo(),
            'name'      => $this->name,
            'slug'      => $this->slug,
            'status'    => (bool) $this->status,
        ];
    }

    public function parentInfo(): ?array
    {
        if (!$this->parent) {
            return null;
        }

        return [
            'id'   => $this->parent->id,
            'name' => $this->parent->name,
            'slug' => $this->parent->slug,
        ];
    }
}
