<?php

namespace Modules\UserManagement\DTOs\OrganizationMember;

use Modules\UserManagement\Http\Requests\OrganizationMember\StoreOrganizationMemberRequest;

class StoreOrganizationMemberData
{
    public function __construct(
        public string $name = '',
        public string $email = '',
        public ?string $phone = null,
        public ?string $password = null,
        public ?string $user_id = null,
        public string $role_id = '',
    ) {}

    public static function make(StoreOrganizationMemberRequest $request): self
    {
        return new self(
            name: $request->input('name'),
            email: $request->input('email'),
            phone: $request->input('phone'),
            password: $request->input('password'),
            user_id: $request->input('user_id'),
            role_id: $request->input('role_id')
        );
    }
}
