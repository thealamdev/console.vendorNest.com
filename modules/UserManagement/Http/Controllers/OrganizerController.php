<?php

namespace Modules\UserManagement\Http\Controllers;

use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Modules\UserManagement\DTOs\Organization\StoreOrganizationData;
use Modules\UserManagement\Http\Requests\Organizer\StoreOrganizerRequest;
use Modules\UserManagement\Http\Resource\StoreOrganizationResource;
use Modules\UserManagement\Services\OrganizationService;

class OrganizerController
{
    public function get(){
        dd('Get organizers');
    }

    /**
     * Store Organization data
     * @param StoreOrganizerRequest $request
     * @param OrganizationService $service
     * @return never
     */
    public function store(StoreOrganizerRequest $request, OrganizationService $service): JsonResponse
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