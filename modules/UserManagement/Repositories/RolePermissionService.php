<?php

namespace Modules\UserManagement\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\UserManagement\DTOs\Role\StoreRoleData;
use Modules\UserManagement\Services\PermissionService;
use Modules\UserManagement\Services\RoleService;

class RolePermissionService
{
    public function __construct(
        protected RoleService $roleService,
        protected PermissionService $permissionService
    ) {}

    public function createRoleWithPermissions(StoreRoleData $data)
    {
        return DB::transaction(function () use ($data) {
            $role = $this->roleService->store($data);
            $role = $this->permissionService->store($role, $data);
            return $role->load('permissions');
        });
    }
}
