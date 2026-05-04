<?php

namespace Modules\AuthManagement\Http\Controllers;

use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Modules\AuthManagement\DTOs\Login\LoginData;
use Modules\AuthManagement\Http\Requests\LoginRequest;
use Modules\AuthManagement\Http\Resources\AuthResource;
use Modules\AuthManagement\Services\LoginService;

class LoginController
{
    public function __invoke(LoginRequest $request, LoginService $service): JsonResponse
    {
        try {
            $data = LoginData::make($request);
            $response = $service->login($data);
            return ApiResponse::success(
                data: new AuthResource($response),
                message: 'User login successfully',
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                message: $e->getMessage(),
                errors: $e
            );
        }
    }
}
