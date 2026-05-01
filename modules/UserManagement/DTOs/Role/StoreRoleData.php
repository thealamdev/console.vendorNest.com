<?php

namespace Modules\UserManagement\DTOs\Role;

use Modules\UserManagement\Http\Requests\Role\StoreRoleRequest;

class StoreRoleData
{
    public function __construct(
        public ?string $organization_id = '',
        public string $organization_type = '',
        public string $name = '',
        public string $description = '',
        public bool $is_editable = true,
        public string $created_by = '',
    ) {}

    public static function make(StoreRoleRequest $request): self
    {
        return new self(
            organization_id: $request->input('organization_id'),
            organization_type: $request->input('organization_type'),
            name: $request->input('name'),
            description: $request->input('description'),
            is_editable: $request->input('is_editable'),
            created_by: $request->input('created_by')
        );
    }
}
