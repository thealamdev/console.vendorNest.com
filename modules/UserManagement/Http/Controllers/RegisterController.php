<?php

namespace Modules\UserManagement\Http\Controllers;

use App\Helpers\ApiResponse;
use Modules\UserManagement\DTOs\Register\RegisterData;
use Modules\UserManagement\Http\Requests\RegisterRequest;
use Modules\UserManagement\Http\Resource\AuthResource;
use Modules\UserManagement\Services\RegisterService;

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
