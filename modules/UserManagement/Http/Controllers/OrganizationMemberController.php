<?php

namespace Modules\UserManagement\Http\Controllers;

use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\Gate;
use Modules\UserManagement\Http\Resources\Organization\StoreOrganizationResource;
use Modules\UserManagement\Models\OrganizationMember;
use Modules\UserManagement\DTOs\OrganizationMember\StoreOrganizationMemberData;
use Modules\UserManagement\Http\Requests\OrganizationMember\StoreOrganizationMemberRequest;
use Modules\UserManagement\Services\OrganizationMemberService;

class OrganizationMemberController
{
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
