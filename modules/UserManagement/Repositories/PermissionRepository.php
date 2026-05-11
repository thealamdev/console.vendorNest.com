<?php

namespace Modules\UserManagement\Repositories;

use Modules\UserManagement\Models\Role;
use Modules\UserManagement\Models\Permission;
use Modules\UserManagement\DTOs\Permission\StorePermissionData;
use Modules\UserManagement\DTOs\Permission\UpdatePermissionData;

class PermissionRepository
{
    /**
     * Get all permissions of authorized user
     * @return array
     */
    public function get(string $roleId): array
    {
        $data = Role::query()
            ->where('id', $roleId)
            ->select('id', 'organization_id', 'slug', 'name')
            // ->where('organization_id', activeOrganizationId())
            ->with([
                'permissions:id,module,name,slug'
            ])
            ->firstOrFail()
            ?->toArray();

        return $data;
    }

    /**
     * Store the data to database
     * @param StorePermissionData $data
     * @return Role
     */
    public function store(Role $role, StorePermissionData $data): Role
    {
        $permissions = Permission::whereIn('slug', $data->permissions)->pluck('id')->toArray();
        $role->permissions()->sync($permissions);
        return $role;
    }

    public function update(Role $role, UpdatePermissionData $data): Role
    {
        $permissions = Permission::whereIn('slug', $data->permissions)->pluck('id')->toArray();
        $role->permissions()->sync($permissions);
        return $role;
    }
}
