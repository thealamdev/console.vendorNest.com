<?php

namespace Modules\UserManagement\Repositories;

use Modules\UserManagement\DTOs\Permission\StorePermissionData;
use Modules\UserManagement\DTOs\Permission\UpdatePermissionData;
use Modules\UserManagement\Models\Role;
use Modules\UserManagement\Models\Permission;

class PermissionRepository
{
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
