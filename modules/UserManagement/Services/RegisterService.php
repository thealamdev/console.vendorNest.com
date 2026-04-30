<?php

namespace Modules\UserManagement\Services;

use Modules\UserManagement\Actions\RegisterAction;
use Modules\UserManagement\DTOs\Register\RegisterData;

class RegisterService
{
    public function __construct(
        public RegisterAction $registerAction
    ) {}

    public function register(RegisterData $data)
    {
        return $this->registerAction->execute($data);
    }
}
