<?php

namespace Modules\UserManagement\Http\Controllers;

use App\Support\Helpers\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Modules\UserManagement\Models\OrganizationMember;
use Modules\UserManagement\Services\PermissionService;
use Modules\UserManagement\Http\Resources\Permission\ListPermissionResource;

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

    public function memberPermissions()
    {
        $permissions = OrganizationMember::where('user_id', Auth::id())
            ->where('organization_id', activeOrganizationId())
            ->with('roles.permissions:id,slug')
            ->first()
            ?->roles
            ->pluck('permissions')
            ->flatten()
            ->pluck('slug')
            ->unique()
            ->values();

        return ApiResponse::success(
            data: $permissions,
            message: 'Permission get successfully'
        );
    }
}
