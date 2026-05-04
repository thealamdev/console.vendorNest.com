<?php

namespace Modules\UserManagement\Actions\Role;

use Modules\UserManagement\DTOs\Role\UpdateRoleData;
use Modules\UserManagement\Models\Role;
use Modules\UserManagement\Repositories\RoleRepository;

class UpdateRoleAction
{
    public function __construct(
        public RoleRepository $repo
    ) {}

    public function execute(Role $role, UpdateRoleData $data)
    {
        return $this->repo->update($role, $data);
    }
}
