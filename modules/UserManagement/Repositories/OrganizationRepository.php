<?php

namespace Modules\UserManagement\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\UserManagement\DTOs\Organization\StoreOrganizationData;
use Modules\UserManagement\Models\MemberRole;
use Modules\UserManagement\Models\Organization;
use Modules\UserManagement\Models\OrganizationMember;

class OrganizationRepository
{
    /**
     * Get specific organizer info
     * @return Organization|\stdClass|null
     */
    public function get(): Organization|\stdClass|null
    {
        $data = Organization::query()
            ->select('id', 'name', 'email', 'type', 'owner_user_id')
            ->where('owner_user_id', Auth::id())
            ->with('owner:id,name,email')
            ->first();

        return $data ?? null;
    }


    /**
     * Store the data to database
     * @param StoreOrganizationData $data
     * @return Organization
     */
    public function store(StoreOrganizationData $data): Organization
    {
        return DB::transaction(function () use ($data) {
            $organization = Organization::create([
                'owner_user_id' => Auth::id(),
                'type'          => $data->type,
                'name'          => $data->name,
                'slug'          => Str::slug($data->name) . '_' . uniqid(),
                'email'         => $data->email,
                'phone'         => $data->phone
            ]);

            $member = OrganizationMember::create([
                'organization_id'   => $organization->id,
                'user_id'           => Auth::id(),
                'invited_by'        => Auth::id(),
                'joined_at'         => now()
            ]);

            MemberRole::create([
                'organization_member_id'    => $member->id,
                'role_id'                   => vendorRoleId(),
                'assigned_by'               => Auth::id()
            ]);
            return $organization;
        });
    }
}
