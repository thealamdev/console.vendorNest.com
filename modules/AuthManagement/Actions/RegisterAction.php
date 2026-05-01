<?php

namespace Modules\AuthManagement\Actions;

use Modules\AuthManagement\DTOs\Register\RegisterData;
use Modules\AuthManagement\Repositories\RegisterRepository;

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
