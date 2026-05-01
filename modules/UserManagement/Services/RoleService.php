<?php

namespace Modules\UserManagement\Services;

use Modules\UserManagement\Actions\Role\StoreRoleAction;
use Modules\UserManagement\DTOs\Role\StoreRoleData;

class RoleService
{
    public function __construct(
        public StoreRoleAction $storeRoleAction
    ) {}

    public function store(StoreRoleData $data)
    {
        return $this->storeRoleAction->execute($data);
    }
}
