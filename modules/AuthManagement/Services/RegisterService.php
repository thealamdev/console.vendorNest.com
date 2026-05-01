<?php

namespace Modules\AuthManagement\Services;

use Modules\AuthManagement\Actions\RegisterAction;
use Modules\AuthManagement\DTOs\Register\RegisterData;

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
