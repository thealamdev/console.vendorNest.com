<?php

namespace Modules\UserManagement\Http\Controllers;

use App\Support\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Modules\UserManagement\Http\Resources\Permission\ListMemberPermissionResource;
use Modules\UserManagement\Http\Resources\Permission\ListPermissionGroupByModuleResource;
use Modules\UserManagement\Services\PermissionService;
use Modules\UserManagement\Http\Resources\Permission\ListPermissionResource;

class PermissionController
{
    /**
     * Get all permissions by role
     * @param string $roleId
     * @param PermissionService $service
     * @return JsonResponse
     */
    public function get(string $roleId, PermissionService $service): JsonResponse
    {
        $response = $service->get($roleId);
        return ApiResponse::success(
            data: new ListPermissionResource($response),
            message: 'Permission get succssfully'
        );
    }

    public function permissionsGroupByModule(PermissionService $service)
    {
        $reponse = $service->permissionsGroupByModule();
        return ApiResponse::success(
            data: new ListPermissionGroupByModuleResource($reponse),
            message: 'Permission get successfully'
        );
    }

    public function memberPermissions(PermissionService $service)
    {
        $reponse = $service->memberPermissions();
        return ApiResponse::success(
            data: new ListMemberPermissionResource($reponse),
            message: 'Get member permissions'
        );
    }
}
