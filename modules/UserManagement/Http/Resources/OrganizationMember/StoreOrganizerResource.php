<?php

namespace Modules\UserManagement\Http\Resources\OrganizationMember;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreOrganizerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'      => $this->resource['name'],
            'email'     => $this->resource['email'],
        ];
    }
}
