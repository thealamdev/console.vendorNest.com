<?php

namespace Modules\AuthManagement\Http\Controllers;

use App\Helpers\ApiResponse;
use Modules\AuthManagement\DTOs\Register\RegisterData;
use Modules\AuthManagement\Http\Requests\RegisterRequest;
use Modules\AuthManagement\Http\Resources\AuthResource;
use Modules\AuthManagement\Services\RegisterService;

class RegisterController
{
    public function __invoke(RegisterRequest $request, RegisterService $service)
    {
        try {
            $data = RegisterData::make($request);
            $response = $service->register($data);
            return ApiResponse::success(
                data: new AuthResource($response),
                message: 'User registered successfully',
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                message: $e->getMessage(),
                errors: $e
            );
        }
    }
}
