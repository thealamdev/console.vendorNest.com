<?php

namespace Modules\UserManagement\Repositories;

use Illuminate\Support\Facades\Auth;
use Modules\UserManagement\Models\Role;
use Modules\UserManagement\Models\Permission;
use Modules\UserManagement\DTOs\Permission\StorePermissionData;
use Modules\UserManagement\DTOs\Permission\UpdatePermissionData;
use Modules\UserManagement\Models\OrganizationMember;

class PermissionRepository
{
    /**
     * Get all permissions of authorized user
     * @return array
     */
    public function get(string $roleId): array
    {
        $data = Role::query()
            ->where('id', $roleId)
            ->select('id', 'organization_id', 'slug', 'name','description','is_editable')
            ->with([
                'permissions:id,module,name,slug'
            ])
            ->firstOrFail()
            ?->toArray();

        return $data;
    }

    /**
     * Get all permissions of vendor
     * @return array
     */
    public function permissionsGroupByModule(): array
    {
        $reponse =  Permission::whereNotIn('module', ['platform', 'user', 'vendor', 'payout'])
            ->get()
            ->groupBy('module')
            ->map(fn($q) => $q->pluck('slug'))
            ->toArray();

        return $reponse;
    }

    /**
     * Get member permissions
     * @return array
     */
    public function memberPermissions(): array
    {
        $response = OrganizationMember::where('user_id', Auth::id())
            ->where('organization_id', activeOrganizationId())
            ->with('roles.permissions:id,slug')
            ->first()
            ?->roles
            ->pluck('permissions')
            ->flatten()
            ->pluck('slug')
            ->unique()
            ->values()
            ?->toArray();

        return $response;
    }

    /**
     * Store the data to database
     * @param StorePermissionData $data
     * @return Role
     */
    public function store(Role $role, StorePermissionData $data): Role
    {
        $permissions = Permission::whereIn('slug', $data->permissions)->pluck('id')->toArray();
        $role->permissions()->sync($permissions);
        return $role;
    }

    public function update(Role $role, UpdatePermissionData $data): Role
    {
        $permissions = Permission::whereIn('slug', $data->permissions)->pluck('id')->toArray();
        $role->permissions()->sync($permissions);
        return $role;
    }
}
