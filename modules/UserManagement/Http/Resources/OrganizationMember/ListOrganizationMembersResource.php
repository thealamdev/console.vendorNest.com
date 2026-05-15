<?php

namespace Modules\UserManagement\Http\Resources\OrganizationMember;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'user_name'         => $this->resource['user']['name'],
            'user_email'        => $this->resource['user']['email'],
            'user_type'         => $this->resource['user']['type'],
            'invited_by_name'   => $this->resource['invited_by']['name'],
            'invited_by_email'  => $this->resource['invited_by']['email'],
            'invited_by_type'   => $this->resource['invited_by']['type']
        ];
    }
}
