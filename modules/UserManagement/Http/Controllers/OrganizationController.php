<?php

namespace Modules\UserManagement\Http\Controllers;

use App\Support\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Modules\UserManagement\DTOs\Organization\CheckOrgContextData;
use Modules\UserManagement\DTOs\Organization\StoreOrganizationData;
use Modules\UserManagement\Http\Requests\Organization\CheckOrgContextRequest;
use Modules\UserManagement\Http\Requests\Organization\StoreOrganizationRequest;
use Modules\UserManagement\Http\Resources\Organization\CheckOrgContextResource;
use Modules\UserManagement\Http\Resources\Organization\StoreOrganizationResource;
use Modules\UserManagement\Http\Resources\Organization\ListOrganizationResource;
use Modules\UserManagement\Services\OrganizationService;

class OrganizationController
{
    /**
     * Get organizer info
     * @param OrganizationService $service
     * @return never
     */
    public function get(OrganizationService $service): JsonResponse
    {
        $response = $service->get();
        return ApiResponse::success(
            data: new ListOrganizationResource($response),
            message: 'Organization get successfully'
        );
    }

    public function checkOrgContext(CheckOrgContextRequest $request, OrganizationService $service)
    {
        try {
            $data = CheckOrgContextData::make($request);
            $response = $service->checkOrgContext($data);
            
            return ApiResponse::success(
                data: new CheckOrgContextResource($response),
                message: 'Organization checked successfully'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                message: $e->getMessage(),
                errors: $e
            );
        }
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
