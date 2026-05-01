<?php

namespace Modules\UserManagement\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Modules\UserManagement\DTOs\Organization\StoreOrganizationData;
use Modules\UserManagement\Models\Organization;

class OrganizationRepository
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
     * @param StoreOrganizationData $data
     * @return Organization
     */
    public function store(StoreOrganizationData $data): Organization
    {
        return Organization::create([
            'owner_user_id' => $data->owner_user_id,
            'type'          => $data->type,
            'name'          => $data->name,
            'slug'          => Str::slug($data->name) . '_' . uniqid(),
            'email'         => $data->email,
            'phone'         => $data->phone
        ]);
    }
}
