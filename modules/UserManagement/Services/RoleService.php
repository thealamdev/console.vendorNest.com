<?php

namespace Modules\UserManagement\Services;

use Modules\UserManagement\Actions\Role\ListRoleAction;
use Modules\UserManagement\Actions\Role\StoreRoleAction;
use Modules\UserManagement\Actions\Role\UpdateRoleAction;
use Modules\UserManagement\DTOs\Role\StoreRoleData;
use Modules\UserManagement\DTOs\Role\UpdateRoleData;
use Modules\UserManagement\Models\Role;

class RoleService
{
    public function __construct(
        public ListRoleAction $listRoleAction,
        public StoreRoleAction $storeRoleAction,
        public UpdateRoleAction $updateRoleAction
    ) {}

    public function getAll()
    {
        return $this->listRoleAction->execute();
    }

    public function store(StoreRoleData $data)
    {
        return $this->storeRoleAction->execute($data);
    }

    public function update(Role $role, UpdateRoleData $data)
    {
        return $this->updateRoleAction->execute($role, $data);
    }
}
