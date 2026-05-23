<?php

namespace Modules\UserManagement\Http\Controllers;

use App\Support\Cache\OrganizationMembersCache;
use App\Support\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Modules\UserManagement\Http\Resources\Organization\StoreOrganizationResource;
use Modules\UserManagement\Models\OrganizationMember;
use Modules\UserManagement\DTOs\OrganizationMember\StoreOrganizationMemberData;
use Modules\UserManagement\DTOs\OrganizationMember\UpdateOrganizationMemberData;
use Modules\UserManagement\Http\Requests\OrganizationMember\StoreOrganizationMemberRequest;
use Modules\UserManagement\Http\Requests\OrganizationMember\UpdateOrganizationMemberRequest;
use Modules\UserManagement\Http\Resources\OrganizationMember\ListOrganizationMemberRolesResource;
use Modules\UserManagement\Http\Resources\OrganizationMember\ListOrganizationMembershipResource;
use Modules\UserManagement\Http\Resources\OrganizationMember\ListOrganizationMembersResource;
use Modules\UserManagement\Services\OrganizationMemberService;

class OrganizationMemberController
{
    /**
     * Initialize the OrganizationMemberService.
     * @param OrganizationMemberService $service
     */
    public function __construct(
        public OrganizationMemberService $service
    ) {}

    /**
     * Get all roles of member
     * @return JsonResponse
     */
    public function roles(): JsonResponse
    {
        $response = $this->service->roles();
        return ApiResponse::success(
            data: new ListOrganizationMemberRolesResource($response),
            message: 'Organization members role get successfully'
        );
    }

    /**
     * Get people inside this org
     * @return JsonResponse
     */
    public function members(): JsonResponse
    {
        $response = $this->service->members();
        return ApiResponse::success(
            data: ListOrganizationMembersResource::collection($response),
            message: 'Organization member get successfully'
        );
    }

    /**
     * Get orgs this user belongs to
     * @return JsonResponse
     */
    public function memberships(): JsonResponse
    {
        $response = $this->service->memberships();
        return ApiResponse::success(
            data: ListOrganizationMembershipResource::collection($response),
            message: 'Organization memberships get successfully'
        );
    }

    /**
     * Store a member info
     * @param StoreOrganizationMemberRequest $request
     * @return JsonResponse
     */
    public function store(StoreOrganizationMemberRequest $request)
    {
        Gate::authorize('store', OrganizationMember::class);
        try {
            $data = StoreOrganizationMemberData::make($request);
            $response = $this->service->store($data);
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

    /**
     * Get a member details
     * @param string $memberId
     * @return JsonResponse
     */
    public function show(string $memberId)
    {
        try {
            $response = $this->service->show($memberId);
            return ApiResponse::success(
                data: new ListOrganizationMembersResource($response),
                message: 'Organization member details get successfully'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                message: $e->getMessage(),
                errors: $e
            );
        }
    }

    public function update(UpdateOrganizationMemberRequest $request, string $memberId)
    {
        $data = UpdateOrganizationMemberData::make($request);

        $member = OrganizationMember::findOrFail($memberId);

        $res = $member->roles()->sync(
            array_fill_keys($data->role_ids, ['assigned_by' => Auth::id()])
        );

        OrganizationMembersCache::forget();

        return ApiResponse::success(
            data: $res,
            message: 'Organization member details get successfully'
        );
    }
}
