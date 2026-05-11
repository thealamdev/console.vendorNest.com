<?php

namespace Modules\UserManagement\Services;

use Modules\UserManagement\Actions\Permission\ListPermissionAction;
use Modules\UserManagement\Models\Role;
use Modules\UserManagement\Actions\Permission\StorePermissionAction;
use Modules\UserManagement\Actions\Permission\UpdatePermissionAction;
use Modules\UserManagement\DTOs\Permission\StorePermissionData;
use Modules\UserManagement\DTOs\Permission\UpdatePermissionData;

class PermissionService
{
    public function __construct(
        public ListPermissionAction $listPermissionAction,
        public StorePermissionAction $storePermissionAction,
        public UpdatePermissionAction $updatePermissionAction
    ) {}

    public function get(string $roleId)
    {
        return $this->listPermissionAction->execute($roleId);
    }

    public function store(Role $role, StorePermissionData $data)
    {
        return $this->storePermissionAction->execute($role, $data);
    }

    public function update(Role $role, UpdatePermissionData $data)
    {
        return $this->updatePermissionAction->execute($role, $data);
    }
}
