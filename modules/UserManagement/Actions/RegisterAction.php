<?php

namespace Modules\UserManagement\Actions;

use Modules\UserManagement\DTOs\Register\RegisterData;
use Modules\UserManagement\Repositories\RegisterRepository;

class RegisterAction
{
    public function __construct(
        public RegisterRepository $repo
    ) {}

    public function execute(RegisterData $data)
    {
        $user = $this->repo->register($data);
        $token = $user->createToken('auth_token')->plainTextToken;
        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}
