<?php

namespace Modules\UserManagement\Http\Controllers;

use Modules\UserManagement\DTOs\Register\RegisterData;
use Modules\UserManagement\Http\Requests\RegisterRequest;
use Modules\UserManagement\Services\RegisterService;

class RegisterController
{
    public function __invoke(RegisterRequest $request, RegisterService $service)
    {
        $data = RegisterData::make($request);
        dd($service->register($data));
    }
}
