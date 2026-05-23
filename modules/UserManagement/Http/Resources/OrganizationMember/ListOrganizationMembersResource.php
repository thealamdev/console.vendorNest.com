<?php

namespace Modules\UserManagement\Http\Resources\OrganizationMember;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class ListOrganizationMembersResource extends JsonResource
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
            'id'        => $this->resource['id'],
            'user'      => $this->usse(),
            'inviter'   => $this->inviter(),
            'roles'     => $this->roles()
        ];
    }

    /**
     * Get the user details of this organization member.
     * @return array{email: string, name: string, type: string}
     */
    public function usse(): array
    {
        return [
            'name'      => $this->resource['user']['name'],
            'email'     => $this->resource['user']['email'],
            'type'      => $this->resource['user']['type']
        ];
    }

    /**
     * Get the inviter details of this organization member.
     * @return array{email: string, name: string, type: string}
     */
    public function inviter(): array
    {
        return [
            'name'      => $this->resource['invited_by']['name'],
            'email'     => $this->resource['invited_by']['email'],
            'type'      => $this->resource['invited_by']['type']
        ];
    }

    public function roles(): Collection
    {
        return collect($this->resource['roles'] ?? [])->map(function ($item) {
            return [
                'id'                => $item['id'],
                'organization_id'   => $item['organization_id'],
                'name'              => $item['name'],
                'slug'              => $item['slug']
            ];
        });
    }
}
