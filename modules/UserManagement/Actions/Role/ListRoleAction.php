<?php

namespace Modules\UserManagement\Actions\Role;

use Modules\UserManagement\Repositories\RoleRepository;

class ListRoleAction
{
    public function __construct(
        public RoleRepository $repo
    ) {}

    public function execute()
    {
        return $this->repo->getAll();
    }
}
