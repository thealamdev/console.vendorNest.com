<?php

namespace Modules\UserManagement\Http\Resources\Role;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\AuthManagement\Models\User;
use Modules\UserManagement\Models\Organization;

class ListRoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'slug'              => $this->slug,
            'created_by'        => $this->Creator($this->createdBy),
            'organization'      => $this->Organization($this->organization),
            'description'       => $this->description,
            'is_editable'       => $this->is_editable,
            'organization_type' => $this->organization_type,
        ];
    }

    public function Creator(?User $data): array
    {
        return [
            'id'    => $data?->id,
            'name'  => $data?->name,
            'email' => $data?->email
        ];
    }

    public function Organization(?Organization $data): array
    {
        return [
            'id'    => $data?->id,
            'name'  => $data?->name,
            'email' => $data?->email
        ];
    }
}
