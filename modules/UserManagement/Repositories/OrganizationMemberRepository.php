<?php

namespace Modules\UserManagement\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\UserResolverService;
use App\Support\Cache\OrganizationMembersCache;
use App\Support\Cache\OrganizationMembershipsCache;
use Modules\UserManagement\Models\MemberRole;
use Modules\UserManagement\Models\OrganizationMember;
use Modules\UserManagement\DTOs\OrganizationMember\StoreOrganizationMemberData;

class OrganizationMemberRepository
{
    public function roles(): array
    {
        $data = OrganizationMember::query()
            ->where('organization_id', activeOrganizationId())
            ->where('user_id', Auth::id())
            ->select('id', 'organization_id', 'user_id')
            ->with('roles:id,organization_id,name,slug')
            ->first()
            ?->toArray();

        return $data;
    }

    public function members(): array
    {
        $data = OrganizationMembersCache::remember(
            callback: fn() => OrganizationMember::query()
                ->where('organization_id', activeOrganizationId())
                ->select('id', 'user_id', 'invited_by', 'organization_id')
                ->with('user:id,name,email,type')
                ->with('invitedBy:id,name,email,type')
                ->get()
                ?->toArray()
        );

        return $data;
    }

    public function memberships(): array
    {
        $data = OrganizationMembershipsCache::remember(
            callback: fn() => OrganizationMember::where('user_id', Auth::id())
                ->where('status', true)
                ->select('id', 'user_id', 'organization_id')
                ->with([
                    'organization:id,owner_user_id,type,name,email,phone',
                ])
                ->get()?->toArray(),
            ttl: 3600
        );

        return $data;
    }

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
