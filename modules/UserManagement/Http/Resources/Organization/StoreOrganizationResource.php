<?php

namespace Modules\UserManagement\Http\Resources\Organization;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreOrganizationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->resource['id'],
            'type'  => $this->resource['type'],
            'name'  => $this->resource['name'],
            'email' => $this->resource['email'],
            'phone' => $this->resource['phone'],
        ];
    }
}
