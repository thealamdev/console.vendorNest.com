<?php

use Modules\UserManagement\Models\Role;

if (!function_exists('activeOrganizationId')) {
    function activeOrganizationId(): ?string
    {
        $orgId = request()->header('X-Organization-Id');

        return $orgId ? (string) $orgId : null;
    }
}

if (!function_exists('vendorRoleId')) {
    function vendorRoleId(): ?string
    {
        $role = Role::query()->where('slug', 'vendor-owner')->where('is_system_role', true)->first();
        return $role->id;
    }
}
