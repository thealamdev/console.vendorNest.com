<?php

namespace Modules\UserManagement\DTOs\Permission;

use Modules\UserManagement\Http\Requests\RolePermission\UpdateRolePermissionRequest;

class UpdatePermissionData
{
    public function __construct(
        public ?array $permissions = [],
    ) {}

    public static function make(UpdateRolePermissionRequest $request): self
    {
        return new self(
            permissions: $request->input('permissions'),

        );
    }
}
