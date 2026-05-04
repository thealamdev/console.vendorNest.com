<?php

namespace Modules\UserManagement\Repositories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Modules\UserManagement\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Modules\UserManagement\DTOs\Role\StoreRoleData;
use Modules\UserManagement\DTOs\Role\UpdateRoleData;

class RoleRepository
{
    /**
     * Get specific organizer info
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Role::query()
            ->select('id', 'organization_id', 'organization_type', 'slug', 'name', 'description', 'is_editable', 'created_by')
            ->where('organization_id', activeOrganizationId())
            ->with('organization:id,name,email')
            ->with('createdBy:id,name,email')
            ->get();
    }


    /**
     * Store the data to database
     * @param StoreRoleData $data
     * @return Role
     */
    public function store(StoreRoleData $data): Role
    {
        return Role::create([
            'organization_id'   => $data->organization_id,
            'organization_type' => $data->organization_type,
            'name'              => $data->name,
            'slug'              => Str::slug($data->name),
            'description'       => $data->description,
            'is_editable'       => $data->is_editable,
            'created_by'        => Auth::id()
        ]);
    }

    public function update(Role $role, UpdateRoleData $data)
    {
        return $role->update([
            'organization_id'   => $data->organization_id,
            'organization_type' => $data->organization_type,
            'name'              => $data->name,
            'slug'              => Str::slug($data->name),
            'description'       => $data->description,
            'is_editable'       => $data->is_editable,
            'created_by'        => Auth::id()
        ]);
    }
}
