<?php

namespace Modules\UserManagement\Http\Controllers;

use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Modules\UserManagement\Services\RoleService;
use Modules\UserManagement\DTOs\Role\StoreRoleData;
use Modules\UserManagement\Http\Requests\Role\StoreRoleRequest;
use Modules\UserManagement\Http\Resources\Role\ListRoleResource;
use Modules\UserManagement\Http\Resources\Role\StoreRoleResource;
use Modules\UserManagement\Services\RolePermissionService;

class RoleController
{
    public function getAll(RoleService $service)
    {
        $response = $service->getAll();
        return ApiResponse::success(
            data: ListRoleResource::collection($response),
            message: 'Role get succssfully'
        );
    }

    public function store(StoreRoleRequest $request, RolePermissionService $service): JsonResponse
    {
        try {
            $data = StoreRoleData::make($request);
            $response = $service->createRoleWithPermissions($data);

            return ApiResponse::success(
                data: new StoreRoleResource($response),
                message: 'Role created succssfully'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                message: $e->getMessage(),
                errors: $e
            );
        }
    }

    public function update()
    {
        dd('Permission');
    }
}
