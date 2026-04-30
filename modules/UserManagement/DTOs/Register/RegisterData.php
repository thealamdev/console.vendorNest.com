<?php

namespace Modules\UserManagement\DTOs\Register;

use Modules\UserManagement\Http\Requests\Auth\RegisterRequest;

class RegisterData
{
    public function __construct(
        public string $name = '',
        public string $email = '',
        public ?string $phone = null,
        public string $password = ''
    ) {}

    public static function make(RegisterRequest $request): self
    {
        return new self(
            name: $request->input('name'),
            email: $request->input('email'),
            phone: $request->input('phone'),
            password: $request->input('password'),
        );
    }
}
