<?php

namespace Modules\UserManagement\Http\Resources\Role;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreRoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'  => $this->resource['name'],
            'slug' => $this->resource['slug'],
            'description' => $this->resource['description'],
            'is_editable'  => $this->resource['is_editable'],
            'organization_type' => $this->resource['organization_type'],
        ];
    }
}
