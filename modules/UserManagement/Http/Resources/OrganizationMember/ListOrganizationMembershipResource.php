<?php

namespace Modules\UserManagement\Http\Resources\OrganizationMember;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListOrganizationMembershipResource extends JsonResource
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

        return [
            'org_id'    => $this->resource['organization']['id'] ?? null,
            'isOwner'   => $this->resource['user_id'] === $this->resource['organization']['owner_user_id'] ? 'Owner' : 'Staff',
            'name'      => $this->resource['organization']['name'] ?? null,
            'email'     => $this->resource['organization']['email'] ?? null,
            'phone'     => $this->resource['organization']['phone'] ?? null,
            'type'      => $this->resource['organization']['type'] ?? null,
        ];
    }
}
