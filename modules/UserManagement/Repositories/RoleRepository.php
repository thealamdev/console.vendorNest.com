<?php

namespace Modules\UserManagement\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Modules\UserManagement\DTOs\Role\StoreRoleData;
use Modules\UserManagement\Models\Organization;
use Modules\UserManagement\Models\Role;

class RoleRepository
{
    /**
     * Get specific organizer info
     * @return Organization|\stdClass|null
     */
    public function get()
    {
        return Organization::query()
            ->select('id', 'name', 'email', 'type', 'owner_user_id')
            ->where('owner_user_id', Auth::id())
            ->with('owner:id,name,email')
            ->first();
    }


    /**
     * Store the data to database
     * @param StoreRoleData $data
     * @return Role
     */
    public function store(StoreRoleData $data): Role
    {
        return Role::create([
            'organization_id'   => $data->organization_id,
            'organization_type' => $data->organization_type,
            'name'              => $data->name,
            'slug'              => Str::slug($data->name),
            'description'       => $data->description,
            'is_editable'       => $data->is_editable,
            'created_by'        => Auth::id()
        ]);
    }
}
