<?php

namespace Modules\UserManagement\Services;

use Modules\UserManagement\Actions\Role\ListRoleAction;
use Modules\UserManagement\Actions\Role\StoreRoleAction;
use Modules\UserManagement\DTOs\Role\StoreRoleData;

class RoleService
{
    public function __construct(
        public ListRoleAction $listRoleAction,
        public StoreRoleAction $storeRoleAction
    ) {}

    public function getAll()
    {
        return $this->listRoleAction->execute();
    }
    
    public function store(StoreRoleData $data)
    {
        return $this->storeRoleAction->execute($data);
    }
}
