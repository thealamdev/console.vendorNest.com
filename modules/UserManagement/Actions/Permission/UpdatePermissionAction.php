<?php

namespace Modules\UserManagement\Actions\Permission;

use Modules\UserManagement\DTOs\Permission\UpdatePermissionData;
use Modules\UserManagement\Models\Role;
use Modules\UserManagement\Repositories\PermissionRepository;

class UpdatePermissionAction
{
    public function __construct(
        public PermissionRepository $repo
    ) {}

    public function execute(Role $role, UpdatePermissionData $data)
    {
        return $this->repo->update($role, $data);
    }
}
