<?php

namespace Modules\UserManagement\Repositories;

use Illuminate\Support\Str;
use Modules\UserManagement\DTOs\Organization\StoreOrganizationData;
use Modules\UserManagement\Models\Organization;

class OrganizationRepository
{
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
