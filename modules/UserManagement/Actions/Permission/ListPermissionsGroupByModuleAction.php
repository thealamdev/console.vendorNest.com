<?php

namespace Modules\UserManagement\Actions\Permission;

use Modules\UserManagement\Repositories\PermissionRepository;

class ListPermissionsGroupByModuleAction
{
    public function __construct(
        public PermissionRepository $repo
    ) {}

    public function execute()
    {
        return $this->repo->permissionsGroupByModule();
    }
}
