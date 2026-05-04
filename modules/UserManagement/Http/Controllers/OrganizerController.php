<?php

namespace Modules\UserManagement\Http\Controllers;

use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Modules\AuthManagement\Models\User;
use Modules\UserManagement\DTOs\Organization\StoreOrganizationData;
use Modules\UserManagement\Http\Requests\Organization\StoreOrganizationRequest;
use Modules\UserManagement\Http\Resource\Organization\ListOrganizationResource;
use Modules\UserManagement\Http\Resource\Organization\StoreOrganizationResource;
use Modules\UserManagement\Services\OrganizationService;

class OrganizerController
{
    /**
     * Get organizer info
     * @param OrganizationService $service
     * @return never
     */
    public function get(OrganizationService $service, User $user): JsonResponse
    {
        $response = $service->get();
        return ApiResponse::success(
            data: new ListOrganizationResource($response),
            message: 'Organization get successfully'
        );
    }

    /**
     * Store Organization data
     * @param StoreOrganizationRequest $request
     * @param OrganizationService $service
     * @return never
     */
    public function store(StoreOrganizationRequest $request, OrganizationService $service): JsonResponse
    {
        try {
            $data = StoreOrganizationData::make($request);
            $response = $service->store($data);
            return ApiResponse::success(
                data: new StoreOrganizationResource($response),
                message: 'Organization created successfully'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                message: $e->getMessage(),
                errors: $e
            );
        }
    }
}
