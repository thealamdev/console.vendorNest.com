<?php

namespace Modules\UserManagement\Actions\Role;

use Modules\UserManagement\DTOs\Role\StoreRoleData;
use Modules\UserManagement\Repositories\RoleRepository;

class StoreRoleAction
{
    public function __construct(
        public RoleRepository $repo
    ) {}

    public function execute(StoreRoleData $data)
    {
        return $this->repo->store($data);
    }
}
