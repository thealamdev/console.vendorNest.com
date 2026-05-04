<?php

namespace Modules\UserManagement\Repositories;

use Modules\UserManagement\Models\Role;
use Modules\UserManagement\DTOs\Role\StoreRoleData;
use Modules\UserManagement\Models\Permission;

class PermissionRepository
{
    /**
     * Store the data to database
     * @param StoreRoleData $data
     * @return Role
     */
    public function store(Role $role, StoreRoleData $data): Role
    {
        $permissions = Permission::whereIn('slug', $data->permissions)->pluck('id')->toArray();
        $role->permissions()->sync($permissions);
        return $role;
    }
}
