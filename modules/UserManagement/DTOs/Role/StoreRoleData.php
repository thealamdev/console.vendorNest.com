<?php

namespace Modules\UserManagement\DTOs\Role;

use Modules\UserManagement\Http\Requests\RolePermission\StoreRolePermissionRequest;


readonly class StoreRoleData
{
    public function __construct(
        public ?string $organization_id = '',
        public string $organization_type = '',
        public string $name = '',
        public ?string $description = '',
        public bool $is_editable = true,
    ) {}

    public static function make(StoreRolePermissionRequest $request): self
    {
        return new self(
            organization_id: activeOrganizationId(),
            organization_type: $request->input('organization_type'),
            name: $request->input('name'),
            description: $request->input('description'),
            is_editable: $request->input('is_editable'),
        );
    }
}
