<?php

namespace Modules\UserManagement\Http\Controllers;

use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Modules\UserManagement\DTOs\Permission\StorePermissionData;
use Modules\UserManagement\DTOs\Permission\UpdatePermissionData;
use Modules\UserManagement\Http\Requests\RolePermission\StoreRolePermissionRequest;
use Modules\UserManagement\Services\RoleService;
use Modules\UserManagement\DTOs\Role\StoreRoleData;
use Modules\UserManagement\DTOs\Role\UpdateRoleData;
use Modules\UserManagement\Http\Requests\RolePermission\UpdateRolePermissionRequest;
use Modules\UserManagement\Http\Resources\Role\ListRoleResource;
use Modules\UserManagement\Http\Resources\Role\StoreRoleResource;
use Modules\UserManagement\Models\Role;
use Modules\UserManagement\Services\RolePermissionService;

class RoleController
{
    public function getAll(RoleService $service)
    {
        Gate::authorize('getAll', Role::class);
        $response = $service->getAll();
        return ApiResponse::success(
            data: ListRoleResource::collection($response),
            message: 'Role get succssfully'
        );
    }

    public function store(StoreRolePermissionRequest $request, RolePermissionService $service): JsonResponse
    {
        Gate::authorize('store', Role::class);
        try {
            $role = StoreRoleData::make($request);
            $permissions = StorePermissionData::make($request);
            $response = $service->createRoleWithPermissions($role, $permissions);

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

    public function update(Role $role, UpdateRolePermissionRequest $request, RolePermissionService $service)
    {
        $updateRoleData = UpdateRoleData::make($request);
        $updatePermissionData = UpdatePermissionData::make(($request));
        
        $response = $service->updateRoleWithPermissions($role, $updateRoleData, $updatePermissionData);


        dd($response);
    }
}
