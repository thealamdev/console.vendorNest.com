<?php

namespace Modules\UserManagement\Http\Controllers;

use App\Support\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Modules\UserManagement\Http\Resources\Organization\StoreOrganizationResource;
use Modules\UserManagement\Models\OrganizationMember;
use Modules\UserManagement\DTOs\OrganizationMember\StoreOrganizationMemberData;
use Modules\UserManagement\Http\Requests\OrganizationMember\StoreOrganizationMemberRequest;
use Modules\UserManagement\Http\Resources\OrganizationMember\ListOrganizationMemberRolesResource;
use Modules\UserManagement\Http\Resources\OrganizationMember\ListOrganizationMembershipResource;
use Modules\UserManagement\Http\Resources\OrganizationMember\ListOrganizationMembersResource;
use Modules\UserManagement\Services\OrganizationMemberService;

class OrganizationMemberController
{

    public function roles(OrganizationMemberService $service): JsonResponse
    {
        $response = $service->roles();
        return ApiResponse::success(
            data: new ListOrganizationMemberRolesResource($response),
            message: 'Organization members role get successfully'
        );
    }

    /**
     * Get people inside this org
     * @param OrganizationMemberService $service
     * @return JsonResponse
     */
    public function members(OrganizationMemberService $service): JsonResponse
    {
        $response = $service->members();
        return ApiResponse::success(
            data: ListOrganizationMembersResource::collection($response),
            message: 'Organization member get successfully'
        );
    }

    /**
     * Get orgs this user belongs to
     * @param OrganizationMemberService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function memberships(OrganizationMemberService $service): JsonResponse
    {
        $response = $service->memberships();
        return ApiResponse::success(
            data: ListOrganizationMembershipResource::collection($response),
            message: 'Organization memberships get successfully'
        );
    }

    public function store(StoreOrganizationMemberRequest $request, OrganizationMemberService $service)
    {
        Gate::authorize('store', OrganizationMember::class);
        try {
            $data = StoreOrganizationMemberData::make($request);
            $response = $service->store($data);
            return ApiResponse::success(
                data: new StoreOrganizationResource($response),
                message: 'Organization member addedd'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                message: $e->getMessage(),
                errors: $e
            );
        }
    }
}
