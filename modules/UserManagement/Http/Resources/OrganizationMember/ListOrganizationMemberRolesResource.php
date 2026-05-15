<?php

namespace Modules\UserManagement\Http\Resources\OrganizationMember;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListOrganizationMemberRolesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (!$this->resource) {
            return [];
        }
        return $this->role();
    }

    public function role(): array
    {
        return collect($this->resource['roles'])->map(function ($value, $key) {
            return [
                'id'    => $value['id'] ?? '',
                'name'  => $value['name'] ?? '',
                'slug'  => $value['slug'] ?? ''
            ];
        })->values()
            ->toArray();
    }
}
