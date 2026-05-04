<?php

namespace Modules\UserManagement\DTOs\OrganizationMember;

use Modules\UserManagement\Http\Requests\OrganizationMember\StoreOrganizationMemberRequest;

class StoreOrganizationMemberData
{
    public function __construct(
        public string $name = '',
        public string $email = '',
        public ?string $phone = null,
        public ?string $user_id = null,
    ) {}

    public static function make(StoreOrganizationMemberRequest $request): self
    {
        return new self(
            name: $request->input('name'),
            email: $request->input('email'),
            phone: $request->input('phone'),
            user_id: $request->input('user_id')
        );
    }
}
