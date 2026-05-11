<?php

namespace Modules\UserManagement\Actions\Permission;

use Modules\UserManagement\Repositories\PermissionRepository;

class ListPermissionAction
{
    public function __construct(
        public PermissionRepository $repo
    ) {}

    public function execute(string $roleId)
    {
        return $this->repo->get($roleId);
    }
}
