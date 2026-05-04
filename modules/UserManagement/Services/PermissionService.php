<?php

namespace Modules\UserManagement\Services;

use Modules\UserManagement\Models\Role;
use Modules\UserManagement\Actions\Permission\StorePermissionAction;
use Modules\UserManagement\Actions\Permission\UpdatePermissionAction;
use Modules\UserManagement\DTOs\Permission\StorePermissionData;
use Modules\UserManagement\DTOs\Permission\UpdatePermissionData;

class PermissionService
{
    public function __construct(
        public StorePermissionAction $storePermissionAction,
        public UpdatePermissionAction $updatePermissionAction
    ) {}

    public function store(Role $role, StorePermissionData $data)
    {
        return $this->storePermissionAction->execute($role, $data);
    }

    public function update(Role $role, UpdatePermissionData $data)
    {
        return $this->updatePermissionAction->execute($role, $data);
    }
}
