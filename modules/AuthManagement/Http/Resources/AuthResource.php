<?php

namespace Modules\AuthManagement\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => $this->userInfo(),
            'memberships'  => $this->memberships(),
            'token' => $this->resource['token'],
        ];
    }

    /**
     * Get the user information from the resource.
     * @return array{email: mixed, id: mixed, name: mixed}
     */
    public function userInfo()
    {
        return [
            'id' => $this->resource['user']->id,
            'name' => $this->resource['user']->name,
            'email' => $this->resource['user']->email,
            'phone' => $this->resource['user']->phone,
        ];
    }

    public function memberships()
    {
        return $this->resource['memberships']->map(fn($item) => [
            'org_id'    => $item->organization->id,
            'org_name'  => $item->organization->name,
            'org_email'  => $item->organization->email,
        ]);
    }
}
