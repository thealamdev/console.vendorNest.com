<?php

namespace Modules\AuthManagement\DTOs\Login;

use Modules\AuthManagement\Http\Requests\LoginRequest;

class LoginData
{
    public function __construct(
        public string $email = '',
        public string $password = ''
    ) {}

    public static function make(LoginRequest $request): self
    {
        return new self(
            email: $request->input('email'),
            password: $request->input('password'),
        );
    }
}
