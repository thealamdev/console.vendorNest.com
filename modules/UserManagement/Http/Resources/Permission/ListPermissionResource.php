<?php

namespace Modules\UserManagement\Http\Resources\Permission;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class ListPermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'          => $this->resource['name'],
            'slug'          => $this->resource['slug'],
            'permissions'   => $this->permisions($this->resource['permissions']) ?? []
        ];
    }

    /**
     * Process all the permissions and get just slug
     * @param array $permissions
     * @return Collection
     */
    public function permisions(array $permissions): Collection
    {
        return collect($permissions)->map(function ($item) {
            return $item['slug'];
        });
    }
}
