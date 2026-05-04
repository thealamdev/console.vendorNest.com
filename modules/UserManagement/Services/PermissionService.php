<?php

namespace Modules\UserManagement\Services;

use Modules\UserManagement\Actions\Permission\StorePermissionAction;
use Modules\UserManagement\DTOs\Role\StoreRoleData;
use Modules\UserManagement\Models\Role;

class PermissionService
{
    public function __construct(
        public StorePermissionAction $storePermissionAction
    ) {}

    public function store(Role $role, StoreRoleData $data)
    {
        return $this->storePermissionAction->execute($role, $data);
    }
}
