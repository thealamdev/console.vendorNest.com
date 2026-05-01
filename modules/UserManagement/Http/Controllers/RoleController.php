<?php

namespace Modules\UserManagement\Http\Controllers;

use Modules\UserManagement\DTOs\Role\StoreRoleData;
use Modules\UserManagement\Http\Requests\Role\StoreRoleRequest;
use Modules\UserManagement\Services\RoleService;

class RoleController
{
    public function store(StoreRoleRequest $request, RoleService $service)
    {
        $data = StoreRoleData::make($request);
        $response = $service->store($data);
        dd($response);
    }
}
