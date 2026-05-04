<?php

namespace  Modules\AuthManagement\Services;

use Modules\AuthManagement\Actions\LoginAction;
use Modules\AuthManagement\DTOs\Login\LoginData;

class LoginService
{
    public function __construct(
        protected LoginAction $loginAction
    ) {}

    /**
     * Execute the login service.
     * @param LoginData $data
     */
    public function login(LoginData $data)
    {
        return $this->loginAction->execute($data);
    }
}
