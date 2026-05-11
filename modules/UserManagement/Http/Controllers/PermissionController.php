<?php

namespace Modules\UserManagement\Http\Controllers;

use App\Support\Helpers\ApiResponse;
use Modules\UserManagement\Http\Resources\Permission\ListPermissionResource;
use Modules\UserManagement\Services\PermissionService;

class PermissionController
{
    public function get(string $roleId, PermissionService $service)
    {
        $response = $service->get($roleId);
        return ApiResponse::success(
            data: new ListPermissionResource($response),
            message: 'Permission get succssfully'
        );
    }
}
