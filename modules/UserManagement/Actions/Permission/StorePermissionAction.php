<?php

namespace Modules\UserManagement\Actions\Permission;

use Modules\UserManagement\DTOs\Role\StoreRoleData;
use Modules\UserManagement\Models\Role;
use Modules\UserManagement\Repositories\PermissionRepository;

class StorePermissionAction
{
    public function __construct(
        public PermissionRepository $repo
    ) {}

    public function execute(Role $role, StoreRoleData $data)
    {
        return $this->repo->store($role, $data);
    }
}
