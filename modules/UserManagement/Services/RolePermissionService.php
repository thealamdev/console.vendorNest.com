<?php

namespace Modules\UserManagement\Services;

use Illuminate\Support\Facades\DB;
use Modules\UserManagement\DTOs\Permission\StorePermissionData;
use Modules\UserManagement\DTOs\Permission\UpdatePermissionData;
use Modules\UserManagement\DTOs\Role\StoreRoleData;
use Modules\UserManagement\DTOs\Role\UpdateRoleData;
use Modules\UserManagement\Models\Role;
use Modules\UserManagement\Services\PermissionService;
use Modules\UserManagement\Services\RoleService;

class RolePermissionService
{
    public function __construct(
        protected RoleService $roleService,
        protected PermissionService $permissionService
    ) {}

    public function createRoleWithPermissions(StoreRoleData $role, StorePermissionData $permissions)
    {
        return DB::transaction(function () use ($role, $permissions) {
            $createdRole = $this->roleService->store($role);
            $createdRole = $this->permissionService->store($createdRole, $permissions);
            return $createdRole->load('permissions');
        });
    }


    public function updateRoleWithPermissions(Role $role, UpdateRoleData $updateRoleData, UpdatePermissionData $updatePermissionData)
    {
        return DB::transaction(function () use ($role, $updateRoleData, $updatePermissionData) {
            $createdRole = $this->roleService->update($role, $updateRoleData);
            $createdRole = $this->permissionService->update($role, $updatePermissionData);
            return $createdRole->load('permissions');
        });
    }
}
