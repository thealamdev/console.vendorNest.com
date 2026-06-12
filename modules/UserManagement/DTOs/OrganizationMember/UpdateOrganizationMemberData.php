<?php

namespace Modules\UserManagement\DTOs\OrganizationMember;

use Modules\UserManagement\Http\Requests\OrganizationMember\UpdateOrganizationMemberRequest;

readonly class UpdateOrganizationMemberData
{
    public function __construct(
        public ?array $role_ids = [],
    ) {}

    public static function make(UpdateOrganizationMemberRequest $request): self
    {
        return new self(
            role_ids: $request->input('role_ids')
        );
    }
}
