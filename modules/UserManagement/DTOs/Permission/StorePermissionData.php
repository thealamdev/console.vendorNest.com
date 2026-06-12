<?php

namespace Modules\UserManagement\DTOs\Permission;

use Modules\UserManagement\Http\Requests\RolePermission\StoreRolePermissionRequest;

readonly class StorePermissionData
{
    public function __construct(
        public ?array $permissions = [],
    ) {}

    public static function make(StoreRolePermissionRequest $request): self
    {
        return new self(
            permissions: $request->input('permissions'),

        );
    }
}
