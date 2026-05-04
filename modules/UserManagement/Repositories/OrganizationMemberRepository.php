<?php

namespace Modules\UserManagement\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\UserResolverService;
use Modules\UserManagement\Models\MemberRole;
use Modules\UserManagement\Models\OrganizationMember;
use Modules\UserManagement\DTOs\OrganizationMember\StoreOrganizationMemberData;

class OrganizationMemberRepository
{
    /**
     * Store the data to database
     * @param StoreOrganizationMemberData $data
     * @return OrganizationMember
     */
    public function store(StoreOrganizationMemberData $data): OrganizationMember
    {
        return DB::transaction(function () use ($data) {
            $user = UserResolverService::resolve($data);

            $member = OrganizationMember::create([
                'organization_id'   => activeOrganizationId(),
                'user_id'           => $user->id,
                'invited_by'        => Auth::id(),
                'joined_at'         => now()
            ]);

            MemberRole::create([
                'organization_member_id'    => $member->id,
                'role_id'                   => $data->role_id,
                'assigned_by'               => Auth::id()
            ]);

            return $member;
        });
    }
}
