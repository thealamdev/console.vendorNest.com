<?php

namespace Modules\UserManagement\Http\Controllers;

use Modules\UserManagement\DTOs\Role\StoreRoleData;
use Modules\UserManagement\Http\Requests\Role\StoreRoleRequest;

class RoleController
{
    public function store(StoreRoleRequest $request)
    {
        $data = StoreRoleData::make($request);
        dd(activeOrganizationId());
    }
}
